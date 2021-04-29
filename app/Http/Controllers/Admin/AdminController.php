<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpAccount;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        $admin_username = $request->admin_username;
        $admin_password =  $request->admin_password;
        $result = Employee::join('emp_account','employee.account_id','emp_account.id')->where([['emp_account.username', $admin_username], ['emp_account.is_enable',1]])->first();
        if ($result && Hash::check($admin_password, $result->password)) {
            // $employee = EmpAccount::find($result->id)->employee->toArray();
            Session::put('admin_name', $result->name);
            Session::put('emp_id', $result->id);
            return Redirect::to('/admin/dashboard');
        }
        else{
            $result = null;
            Session::put('message', 'Mật khẩu hoặc tài khoản không chính xác!</br> Vui lòng kiểm tra lại.');
            return Redirect::to('/admin');
        }

    }
    public function getAdminLogout()
    {
        Session::put('admin_name', null);
        Session::put('emp_id', null);
        return Redirect::to('/admin');
    }

}
