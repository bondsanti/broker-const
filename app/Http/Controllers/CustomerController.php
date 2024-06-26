<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\File;
use App\Models\Image;
use App\Models\Log;
use App\Models\Log_status;
use App\Models\Notify;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        //$dataLoginUser = Role_user::where('user_id', Session::get('loginId'))->first();
        $dataLoginUser = User::where('user_id', Session::get('loginId'))->first();
        $isRole = Role_user::where('user_id', Session::get('loginId'))->first();

        $status = $request->input('status', []);
        $notify_ids = $request->input('notify_id', []);
        $date_select = $request->input('date_select', '');
        $startdate = $request->input('startdate', '');
        $enddate = $request->input('enddate', '');

        $name_customers = $request->input('name_customer', '');
        $phone_customers = $request->input('phone_customer', '');

        // แปลงค่าชื่อลูกค้าและเบอร์โทรศัพท์ให้เป็น array
        $name_customers_array = array_filter(array_map('trim', explode(',', $name_customers)));
        $phone_customers_array = array_filter(array_map('trim', explode(',', $phone_customers)));


        $Notify = Notify::orderBy('name', 'asc')->get();

        $query = Customer::with('notify_ref:id,name,sla')->whereNull('deleted_at');

        if (!empty($name_customers_array)) {
            $query->where(function ($q) use ($name_customers_array) {
                foreach ($name_customers_array as $name_customer) {
                    $q->orWhere('cus_name', 'like', '%' . $name_customer . '%');
                }
            });
        }

        // ตรวจสอบและเพิ่มเงื่อนไขการค้นหาตามเบอร์โทรศัพท์หลายค่า
        if (!empty($phone_customers_array)) {
            $query->where(function ($q) use ($phone_customers_array) {
                foreach ($phone_customers_array as $phone_customer) {
                    $q->orWhere('tel', 'like', '%' . $phone_customer . '%');
                }
            });
        }

        if ($request->filled('status') && is_array($status)) {
            $query->whereIn('status', $status);
        }

        if ($request->filled('notify_id') && is_array($notify_ids)) {
            $query->whereIn('notify_id', $notify_ids);
        }

        if ($date_select && $startdate && $enddate) {
            switch ($date_select) {
                case 'cus_date':
                    $query->whereBetween('cus_date', [$startdate, $enddate]);
                    break;
                case 'status_date':
                    $query->whereBetween('status_date', [$startdate, $enddate]);
                    break;
                case 'onsite_date':
                    $query->whereBetween('onsite_date', [$startdate, $enddate]);
                    break;
            }
        }

        $Customers = $query->orderBy('cus_no', 'desc')->get();
        //dd($Customers);
        return view('customers.index', compact('isRole', 'dataLoginUser', 'Notify', 'Customers'));
    }


    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'cus_name' => 'required',
            'tel' => 'required',
            'notify_id' => 'required',
            'budget' => 'required',
            'location' => 'required',
        ], [
            'cus_name.required' => 'กรุณากรอกชื่อลูกค้า',
            'tel.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'notify_id.required' => 'กรุณาเลือกลักษณะงาน',
            'budget.required' => 'กรุณากรอกงบประมาณ',
            'location.required' => 'กรุณากรอกสถานที่',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        // Format the budget
        $budget = str_replace(',', '', $request->budget);

        // Generate cus_no
        // $lastCusNo = Customer::max('cus_no');
        // $nextCusNo = $lastCusNo ? 'BCO-' . sprintf('%03d', intval(explode('-', $lastCusNo)[1] ?? 0) + 1) : 'BCO-001';


        $allCusNos = Customer::orderBy('cus_no')->pluck('cus_no')->toArray();
        $existingNumbers = array_map(function ($cusNo) {
            return intval(explode('-', $cusNo)[1]);
        }, $allCusNos);

        $nextCusNo = null;
        for ($i = 1; $i <= count($existingNumbers) + 1; $i++) {
            if (!in_array($i, $existingNumbers)) {
                $nextCusNo = 'BCO-' . sprintf('%03d', $i);
                break;
            }
        }

        $customer = Customer::create([
            'cus_no' => $nextCusNo,
            'cus_name' => $request->cus_name,
            'tel' => $request->tel,
            'status' => 'อยู่ระหว่างประสานงาน',
            'notify_id' => $request->notify_id,
            'budget' => $budget,
            'location' => $request->location,
            'cus_date' => $request->cus_date,
            'onsite_date' => $request->onsite_date,
            'maps' => $request->maps,
            'detail' => $request->detail,
            'remark' => $request->remark,
        ]);
        if ($request->hasFile('images')) {
            $imageData = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/images', $image, $filename);
                $imageData[] = ['cus_id' => $customer->id, 'url' => $filename];
            }
            Image::insert($imageData);
        }


        if ($request->hasFile('files')) {
            $fileData = [];
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                Storage::putFileAs('public/files', $file, $filename);
                $fileData[] = ['cus_id' => $customer->id, 'url' => $filename];
            }
            File::insert($fileData);
        }

        return response()->json(['message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'], 201);
    }

    public function edit($id)
    {
        $Customers = Customer::with('notify_ref:id,name,sla', 'img_ref:id,cus_id,url', 'file_ref:id,cus_id,url')->whereNull('deleted_at')->findOrFail($id);
        return response()->json($Customers, 200);
    }

    public function logStatus($id)
    {

        $Customers = Log_status::where('cus_id', $id)->get();

        return response()->json($Customers, 200);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cus_name_edit' => 'required',
            'tel_edit' => 'required',
            'notify_id_edit' => 'required',
            'budget_edit' => 'required',
            'location_edit' => 'required',
        ], [
            'cus_name_edit.required' => 'กรุณากรอกชื่อลูกค้า',
            'tel_edit.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'notify_id_edit.required' => 'กรุณาเลือกลักษณะงาน',
            'budget_edit.required' => 'กรุณากรอกงบประมาณ',
            'location_edit.required' => 'กรุณากรอกสถานที่',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $budget = str_replace(',', '', $request->budget_edit);

        $Customers = Customer::where('id', $request->id_edit)->first();
        $Customers->cus_name = $request->cus_name_edit;
        $Customers->tel = $request->tel_edit;
        $Customers->notify_id = $request->notify_id_edit;
        $Customers->budget = $budget;
        $Customers->location = $request->location_edit;
        $Customers->maps = $request->maps_edit;
        $Customers->detail = $request->detail_edit;
        $Customers->remark = $request->remark_edit;
        $Customers->cus_date = $request->cus_date_edit;
        $Customers->onsite_date = $request->onsite_date_edit;
        $Customers->save();
        $Customers->refresh();

        //รูปภาพ
        if ($request->hasFile('images_edit')) {
            foreach ($request->file('images_edit') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                // Save the image to storage
                // $image->storeAs('public/images', $filename);
                Storage::putFileAs('public/images', $image, $filename);
                Image::create([
                    'cus_id' => $Customers->id,
                    'url' => $filename,
                ]);
            }
        } else {
            // กรณีไม่มีไฟล์ที่อัปโหลด
        }

        //ไฟล์
        if ($request->hasFile('files_edit')) {
            foreach ($request->file('files_edit') as $file) {
                $filename2 = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                Storage::putFileAs('public/files', $file, $filename2);
                File::create([
                    'cus_id' => $Customers->id,
                    'url' => $filename2,
                ]);
            }
        } else {
            // กรณีไม่มีไฟล์ที่อัปโหลด
        }

        return response()->json(['message' => 'แก้ไขข้อมูลเรียบร้อยแล้ว'], 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $Log_status = new Log_status();
        $Log_status->user_id = Session::get('loginId');
        $Log_status->cus_id =  $id;
        $Log_status->status =  $request->status;
        $Log_status->save();

        $Customers = Customer::find($id);
        $Customers_old = $Customers->toArray();
        if ($Customers) {
            $Customers->status = $request->status;
            $Customers->status_date = Carbon::now()->startOfDay()->toDateString();
            $Customers->save();

            Log::addLog(Session::get('loginId'), json_encode($Customers_old), 'Update Status : ' . $Customers);
            return response()->json(['message' => 'อัปเดตสถานะเรียบร้อยแล้ว'], 200);
        }
    }

    public function destroy($id)
    {
        //$roleUser = Role_user::where('id', Session::get('loginId'))->first();

        //Admin ระบบข้อมูล จริง
        // if ($roleUser->role_type=='SuperAdmin') {

        $Customers = Customer::where('id', $id)->first();
        $Customers_old = $Customers->toArray();

        $Files = File::where('cus_id', $Customers->id)->first();

        if ($Files) {
            // ลบไฟล์จาก storage
            $filePath = 'public/files/' . $Files->filename;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // ลบข้อมูลไฟล์จากฐานข้อมูล
            $Files->delete();
        }
        $Images = Image::where('cus_id', $Customers->id)->first();
        if ($Images) {
            // ลบไฟล์จาก storage
            $filePath = 'public/images/' . $Images->filename;
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }

            // ลบข้อมูลไฟล์จากฐานข้อมูล
            $Images->delete();
        }

        Log::addLog(Session::get('loginId'), json_encode($Customers_old), 'Delete Customer : ' . $Customers);

        $Customers->delete($id);


        return response()->json([
            'message' => 'ลบข้อมูลสำเร็จ'
        ], 200);

        // }else{

        // SoftDelate
        // $Customers = Customer::where('id', $id)->first();
        // $Customers_old = $Customers->toArray();

        // $Customers->cus_no = null;
        // $Customers->deleted_at = Carbon::now();
        // $Customers->save();

        // return response()->json([
        //     'message' => 'ลบข้อมูลสำเร็จ'
        // ], 200);

        // }


    }

    public function deleteImg($id)
    {
        try {
            $image = Image::findOrFail($id);

            Storage::delete('public/images/' . $image->url);

            $image->delete();
            return response()->json(['message' => 'ลบรูปสำเร็จ'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error ไม่สามารถลบรูปได้'], 500);
        }
    }

    public function deleteFile($id)
    {
        try {
            $file = File::findOrFail($id);

            Storage::delete('public/files/' . $file->url);

            $file->delete();
            return response()->json(['message' => 'ลบไฟล์สำเร็จ'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error ไม่สามารถลบไฟล์ได้'], 500);
        }
    }
}
