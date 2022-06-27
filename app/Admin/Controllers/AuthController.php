<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function getLogin(){
        if(Auth::guard('admin')->check()){
            return redirect()->route('dashboard.index');
        }else{
            return view('admin.login');
        }
    }

    public function postLogin(Request $request){
        if(Auth::guard('admin')->attempt($request->only('username','password'))){
            if(!auth()->guard('admin')->user()->hasPermissionTo('Bảng quản trị')){
                return redirect()->route('admin.commission.index')->with('success','Đăng nhập thành công');
            }
            if(session()->has('url-redirect')){
                $url = session()->get('url-redirect');
                session()->forget('url-redirect');
                return redirect($url)->with('success', 'Đăng nhập thành công');
            }
            return redirect()->route('dashboard.index')->with('success','Đăng nhập thành công');
        }else{
            return back()->with('error','Đăng nhập thất bại');

        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.getLogin')->with('success','Đăng xuất thành công');
    }
}
