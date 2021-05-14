<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function login()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $username=$request->username;
        $password=md5($request->password);
        $admin=Admin::where([['username',$username],['password',$password]])->get();
        if(count($admin)==0){
            return redirect()->back()->with('alert','Sai tên đăng nhập hoặc mật khẩu');
        }else{
            session(['admin'=>$username]);
            return redirect('admin');
        }
    }

    public function logout(){
        session()->forget('admin');
        return redirect('admin');
    }
}
