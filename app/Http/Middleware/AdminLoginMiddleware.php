<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('emp_account')->check())
        {
            $admin = Employee::where('account_id', Auth::guard('emp_account')->id())->first();
            $level =  $admin->department->level;
            if($level == 2){
                return $next($request);
            }else{
                Session::put('message', 'Bạn không có quyền truy cập!</br> Vui lòng kiểm tra lại.');
                return redirect('admin');
            }
        }else{
            return redirect('admin');
        }
    }
}
