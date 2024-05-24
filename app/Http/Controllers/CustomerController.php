<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\File;
use App\Models\Image;
use App\Models\Notify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function index(Request $request)
    {

        $Notify = Notify::orderBy('name', 'asc')->get();
        $Customers = Customer::with('notify_ref:id,name,sla')->whereNull('deleted_at')->orderBy('id', 'desc')->get();
        //dd($Customers);
        return view('customers.index', compact('Notify', 'Customers'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

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

        $budget = str_replace(',', '', $request->budget);

        // Generate cus_no
        $lastCusNo = Customer::max('cus_no');
        if ($lastCusNo) {
            $lastCusNo = explode('-', $lastCusNo)[1] ?? null; // เอาเลขสุดท้าย
            $nextCusNo = 'BCO-' . sprintf('%03d', intval($lastCusNo) + 1);
        } else {
            // กรณีไม่มีข้อมูลในฐานข้อมูล
            $nextCusNo = 'BCO-001';
        }

        $Customers = new Customer();
        $Customers->cus_no = $nextCusNo;
        $Customers->cus_name = $request->cus_name;
        $Customers->tel = $request->tel;
        $Customers->status = "อยู่ระหว่างประสานงาน";
        $Customers->notify_id = $request->notify_id;
        $Customers->budget = $budget;
        $Customers->location = $request->location;
        $Customers->maps = $request->maps;
        $Customers->detail = $request->detail;
        $Customers->remark = $request->remark;
        $Customers->save();
        $Customers->refresh();

        //dd($Customers->id);
        //รูปภาพ
        if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
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
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
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

        // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        return response()->json(['message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'], 201);
    }

    public function edit($id)
    {
        $Customers = Customer::with('notify_ref:id,name,sla','img_ref:id,cus_id,url','file_ref:id,cus_id,url')->whereNull('deleted_at')->findOrFail($id);
        return response()->json($Customers, 200);
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'code_edit' => 'required',
            'role_type_edit' => 'required',
        ], [
            'code_edit.required' => 'กรุณากรอกรหัสพนักงาน',
            'role_type_edit.required' => 'กรุณาเลือกสิทธิ์การใช้งาน',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $user = User::where('code', $request->code_edit)->where('active', 1)->first();

        if (!$user) {
            return response()->json(['message' => 'ไม่พบผู้ใช้งาน'], 400);
        }

        // $existingRole = Role_user::where('user_id', $user->id)->where('role_type', $request->role_type_edit)->first();

        // if ($existingRole) {
        //     return response()->json(['message' => 'มีผู้ใช้ท่านนี้อยู่ในระบบแล้ว'], 400);
        // }

        //dd($request->all());

        // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        $roleUser = Role_user::where('id', $request->id_edit)->first();
        $roleUser->user_id = $user->id;
        $roleUser->role_type = $request->role_type_edit;
        $roleUser->save();

        return response()->json(['message' => 'แก้ไขข้อมูลเรียบร้อยแล้ว'], 201);
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


            // Log::addLog($user_id,json_encode($roleUser_old), 'Delete RoleUser : '.$roleUser);
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


    public function delImg($id)
    {
        try {
            $image = Image::findOrFail($id);

            Storage::delete('public/images/' . $image->url);

            $image->delete();
            return response()->json(['success' => 'ลบรูปสำเร็จ'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error ไม่สามารถลบรูปได้'], 500);
        }
    }

    public function delFile($id)
    {
        try {
            $file = File::findOrFail($id);

            Storage::delete('public/files/' . $file->url);

            $file->delete();
            return response()->json(['success' => 'ลบไฟล์สำเร็จ'],200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error ไม่สามารถลบไฟล์ได้'], 500);
        }
    }
}
