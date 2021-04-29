<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Core\AjaxController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend

Route::get('/', [HomeController::class, 'index'] );
Route::get('/trang-chu',  [HomeController::class, 'index']);
Route::get('/hello', function (){
    return 'Hello World';
});




//Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin-login', [AdminController::class, "postAdminLogin"]);
Route::get('/admin-logout', [AdminController::class, "getAdminLogout"]);
Route::get('/admin/dashboard', [AdminController::class, 'showDashboard']);
//Validation

//Ajax
Route::group(['prefix'=>'ajax'], function (){
    Route::post('check-exists', [AjaxController::class, 'checkExists']);
});
//Employee
Route::group(['prefix'=>'/admin/nhan-vien'],function (){
Route::get('/danh-sach', [EmployeeController::class, 'index']);
Route::post('/validate', [EmployeeController::class, 'validateElement']);
Route::get('/them', [EmployeeController::class, 'create']);
Route::get('/sua', [EmployeeController::class, 'edit']);
Route::get('/xoa', [EmployeeController::class, 'destroy']);
Route::post('/store', [EmployeeController::class, 'store']);
Route::post('/update', [EmployeeController::class, 'update']);
});
