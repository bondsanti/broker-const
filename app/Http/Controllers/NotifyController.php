<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Notify;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class NotifyController extends Controller
{
    public function index()
    {

     $Notify = Notify::orderBy('id', 'desc')->get();
     $Emails = DB::table('emails')->orderBy('id', 'desc')->get();
     return view('notify.index',compact('Notify','Emails'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:notify',
            'sla' => 'required|numeric',
        ], [
            'name.required' => 'กรุณากรอกชื่อลักษณะงาน',
            'name.unique' => 'ชื่อลักษณะงานนี้มีอยู่ในระบบแล้ว',
            'sla.required' => 'กรุณากรอกชื่อจำนวน วัน SLA',
            'sla.numeric' => 'กรุณากรอกเฉพาะตัวเลขเท่านั้น',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $Notify = new Notify();
        $Notify->name = $request->name;
        $Notify->sla = $request->sla;
        $Notify->save();

        // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        return response()->json(['message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'], 201);
    }

    public function edit($id)
    {
        $Notify = Notify::findOrFail($id);
        return response()->json($Notify, 200);
    }

    public function destroy($id)
    {
        $Notify = Notify::where('id', $id)->first();
        $Notify_old = $Notify->toArray();

        // Log::addLog($user_id,json_encode($roleUser_old), 'Delete RoleUser : '.$roleUser);
        $Notify->delete($id);

        return response()->json([
            'message' => 'ลบข้อมูลสำเร็จ'
        ], 201);
    }


    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_edit' => 'required',
            'sla_edit' => 'required|numeric',
        ], [
            'name_edit.required' => 'กรุณากรอกชื่อลักษณะงาน',
            'sla_edit.required' => 'กรุณากรอกชื่อจำนวน วัน SLA',
            'sla_edit.numeric' => 'กรุณากรอกเฉพาะตัวเลขเท่านั้น',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }


        $Notify = Notify::where('id', $request->id_edit)->first();
        $Notify->name = $request->name_edit;
        $Notify->sla = $request->sla_edit;
        $Notify->save();

                // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        return response()->json(['message' => 'แก้ไขข้อมูลเรียบร้อยแล้ว'], 201);
    }


    public function storeEmail(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:emails',
        ], [
            'email.required' => 'กรุณากรอกอีเมล์',
            'email.unique' => 'อีเมล์นี้มีในระบบแล้ว',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $Email = new Email();
        $Email->email = $request->email;
        $Email->save();

        // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        return response()->json(['message' => 'เพิ่มข้อมูลเรียบร้อยแล้ว'], 201);
    }

    public function editEmail($id)
    {
        $Email = Email::findOrFail($id);
        return response()->json($Email, 200);
    }

    public function updateEmail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email_edit' => 'required',
        ], [
            'email_edit.required' => 'กรุณากรอกอีเมล์',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }


        $Email = Email::where('id', $request->id_email_edit)->first();
        $Email->email = $request->email_edit;
        $Email->save();

        // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        return response()->json(['message' => 'แก้ไขข้อมูลเรียบร้อยแล้ว'], 201);
    }

    public function updateStatusEmail(Request $request)
    {
        $Email = Email::findOrFail($request->id);
        if ($Email) {
            $Email->active = $request->active;
            $Email->save();

            return response()->json(['message' => 'อัพเดทเรียบร้อย']);
        }

        return response()->json(['message' => 'error'], 404);
    }

    public function destroyEmail($id)
    {
        $Email = Email::where('id', $id)->first();
        $Email_old = $Email->toArray();

        // Log::addLog($user_id,json_encode($roleUser_old), 'Delete RoleUser : '.$roleUser);
        $Email->delete($id);

        return response()->json([
            'message' => 'ลบข้อมูลสำเร็จ'
        ], 201);
    }

}
