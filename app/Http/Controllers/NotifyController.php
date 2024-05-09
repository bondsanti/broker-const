<?php

namespace App\Http\Controllers;
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
}
