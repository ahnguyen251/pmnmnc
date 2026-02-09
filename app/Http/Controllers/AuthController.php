<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signIn()
    {
        return view('register');
    }
    public function checkSignIn(Request $request)
    {
        $data = $request->all();

        $exists = \App\Models\User::where('username', $data['username'])
            ->orWhere('mssv', $data['mssv'])
            ->exists();
        if ($exists) {
            return "Đăng ký thất bại: Username hoặc MSSV đã tồn tại";
        }
        if ($data['password'] != $data['repass']) {
            return "Đăng ký thất bại: Mật khẩu không khớp";
        }

        $user = new \App\Models\User();
        $user->username = $data['username'];
        $user->mssv = $data['mssv'];
        $user->password = bcrypt($data['password']);
        $user->lopmonhoc = $data['lopmonhoc'] ?? null;
        $user->gioitinh = $data['gioitinh'] ?? null;
        $user->save();
        return "Đăng ký thành công";
    }
}
