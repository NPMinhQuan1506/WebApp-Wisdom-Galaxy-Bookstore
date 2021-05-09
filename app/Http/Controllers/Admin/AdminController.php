<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpAccount;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //
    public function index()
    {
        return View('admin.admin_login');
    }
    public function showDashboard()
    {
        return View('admin.dashboard');
    }
    public function postAdminLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if ($request->remember == trans('remember.Remember Me')) {
            $remember = true;
        } else {
            $remember = false;
        }
        if (Auth::guard('emp_account')->attempt($credentials)) {
            $request->session()->regenerate();
            $admin = Employee::where('account_id', Auth::guard('emp_account')->id())->first();
            Session::put('admin', $admin);
            return redirect()->intended('/admin/dashboard');
        }
        else {
            Session::put('message', 'Mật khẩu hoặc tài khoản không chính xác!</br> Vui lòng kiểm tra lại.');
            return Redirect::to('/admin');
        }
    }
    public function getAdminLogout()
    {
        Session::put('admin_name', null);
        Auth::logout();
        session()->flush();
        return Redirect::to('/admin');
    }

}
