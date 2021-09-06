<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;


session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        // function xac thuc dang nhap
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        // $request->admin_email  , admin_email chinh la name ben input blade
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;
        $result = DB::table('tbl_admin_models')->where('admin_email', $admin_email)
        ->where('admin_password', $admin_password)->first();
        // neu dang nhap success
        if($result) {
            // put: đặt, admin_name là cột admin_name trỏ từ biến result ($result đã đi vào db)
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');

        }else{
            Session::put('message', 'Mat khau hoac tai khoan bi sai@@');
            return Redirect::to('/admin');
        }
    }
    public function logout(Request $request){
        //khi logout thi xoa session
        $this->AuthLogin();

        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
