<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class AdminController extends Controller
{
    //

    public function adminLoginForm()
    {
        return view('backend.admin.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
           'email'=>'required|email',
            'password'=>'required',
        ]);
        if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/admin/dashboard');
        }else{
            Session::flash('error-msg','Invalid Email Or Password!');
            return redirect()->back();
        }
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('login/admin');
    }
}
