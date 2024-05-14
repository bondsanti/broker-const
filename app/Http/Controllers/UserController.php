<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Role_user;
use App\Models\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {


        $users = Role_user::with('user_ref:id,code,name_th,name_eng,position_id,active', 'user_ref.position_ref:id,name')->orderBy('id', 'desc')->get();

        // นับจำนวนผู้ใช้ทั้งหมด
        $countUser = $users->count();

        $countUserSPAdmin = $users->where('role_type', 'SuperAdmin')->count();
        $countUserAdmin = $users->where('role_type', 'Admin')->count();
        $countUserStaff = $users->where('role_type', 'Staff')->count();
        $countUsers = $users->where('role_type', 'User')->count();

        // dd($users);
        return view(
            'users.index',
            compact(
                'users',
                'countUserSPAdmin',
                'countUserAdmin',
                'countUserStaff',
                'countUsers'
            )
        );
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'role_type' => 'required',
        ], [
            'code.required' => 'กรุณากรอกรหัสพนักงาน',
            'role_type.required' => 'กรุณาเลือกสิทธิ์การใช้งาน',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        $user = User::where('code', $request->code)->where('active', 1)->first();

        if (!$user) {
            return response()->json(['message' => 'ไม่พบผู้ใช้งาน'], 400);
        }

        $existingRole = Role_user::where('user_id', $user->id)->first();

        if ($existingRole) {
            return response()->json(['message' => 'มีผู้ใช้ท่านนี้อยู่ในระบบแล้ว'], 400);
        }

        $roleUser = new Role_user();
        $roleUser->user_id = $user->id;
        $roleUser->role_type = $request->role_type;
        $roleUser->save();

        // Log::addLog(Session::get('loginId'), 'Create User', $roleUser);

        return response()->json(['message' => 'เพิ่มผู้ใช้งานเรียบร้อยแล้ว'], 201);
    }


    public function edit($id)
    {
        $users = Role_user::with('user_ref:id,code,name_th,name_eng,position_id,active', 'user_ref.position_ref:id,name')->findOrFail($id);
        return response()->json($users, 200);
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
        $roleUser = Role_user::where('id', $id)->first();
        $roleUser_old = $roleUser->toArray();

        // Log::addLog($user_id,json_encode($roleUser_old), 'Delete RoleUser : '.$roleUser);
        $roleUser->delete($id);

        return response()->json([
            'message' => 'ลบข้อมูลสำเร็จ'
        ], 201);
    }
}
