<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerTypeController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Core\AjaxController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use App\Http\Controllers\Core\GoogleDriverController;
use App\Models\Employee;

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
    $admin = Employee::find(1)->first();
    $level =  $admin->department->level;
    return  $level;
});
//Backend
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin-login', [AdminController::class, "postAdminLogin"]);
Route::get('/admin-logout', [AdminController::class, "getAdminLogout"]);

//Validation

//Ajax
Route::group(['prefix'=>'ajax'], function (){
    Route::post('check-exists', [AjaxController::class, 'checkExists']);
});
Route::group(['prefix'=>'/admin','namespace'=>'Admin','middleware'=>'loginAdmin'],function(){
    Route::get('/dashboard', [AdminController::class, 'showDashboard']);
//Employee
Route::group(['prefix'=>'/nhan-vien'],function (){
Route::get('/danh-sach', [EmployeeController::class, 'index']);
Route::post('/validate', [EmployeeController::class, 'validateElement']);
Route::get('/them', [EmployeeController::class, 'create']);
Route::get('/sua/{id}', [EmployeeController::class, 'edit']);
Route::get('/xoa/{id}', [EmployeeController::class, 'destroy']);
Route::post('/store', [EmployeeController::class, 'store']);
Route::post('/update/{id}', [EmployeeController::class, 'update']);
});
//Customer
Route::group(['prefix'=>'/khach-hang'],function (){
    Route::get('/danh-sach', [CustomerController::class, 'index']);
    Route::post('/validate', [CustomerController::class, 'validateElement']);
    Route::get('/them', [CustomerController::class, 'create']);
    Route::get('/sua/{id}', [CustomerController::class, 'edit']);
    Route::get('/xoa/{id}', [CustomerController::class, 'destroy']);
    Route::post('/store', [CustomerController::class, 'store']);
    Route::post('/update/{id}', [CustomerController::class, 'update']);
    });
 //CustomerType
Route::group(['prefix'=>'/loai-khach-hang'],function (){
    Route::get('/danh-sach', [CustomerTypeController::class, 'index']);
    Route::post('/validate', [CustomerTypeController::class, 'validateElement']);
    Route::get('/them', [CustomerTypeController::class, 'create']);
    Route::get('/sua/{id}', [CustomerTypeController::class, 'edit']);
    Route::get('/xoa/{id}', [CustomerTypeController::class, 'destroy']);
    Route::post('/store', [CustomerTypeController::class, 'store']);
    Route::post('/update/{id}', [CustomerTypeController::class, 'update']);
    });
//Author
Route::group(['prefix'=>'/tac-gia'],function (){
    Route::get('/danh-sach', [AuthorController::class, 'index']);
    Route::post('/validate', [AuthorController::class, 'validateElement']);
    Route::get('/them', [AuthorController::class, 'create']);
    Route::get('/sua/{id}', [AuthorController::class, 'edit']);
    Route::get('/xoa/{id}', [AuthorController::class, 'destroy']);
    Route::post('/store', [AuthorController::class, 'store']);
    Route::post('/update/{id}', [AuthorController::class, 'update']);
    });
//Publisher
Route::group(['prefix'=>'/nha-xuat-ban'],function (){
    Route::get('/danh-sach', [PublisherController::class, 'index']);
    Route::post('/validate', [PublisherController::class, 'validateElement']);
    Route::get('/them', [PublisherController::class, 'create']);
    Route::get('/sua/{id}', [PublisherController::class, 'edit']);
    Route::get('/xoa/{id}', [PublisherController::class, 'destroy']);
    Route::post('/store', [PublisherController::class, 'store']);
    Route::post('/update/{id}', [PublisherController::class, 'update']);
    });
//Supplier
Route::group(['prefix'=>'/nha-cung-cap'],function (){
    Route::get('/danh-sach', [SupplierController::class, 'index']);
    Route::post('/validate', [SupplierController::class, 'validateElement']);
    Route::get('/them', [SupplierController::class, 'create']);
    Route::get('/sua/{id}', [SupplierController::class, 'edit']);
    Route::get('/xoa/{id}', [SupplierController::class, 'destroy']);
    Route::post('/store', [SupplierController::class, 'store']);
    Route::post('/update/{id}', [SupplierController::class, 'update']);
    });
 //Department
Route::group(['prefix'=>'/chuc-vu'],function (){
    Route::get('/danh-sach', [DepartmentController::class, 'index']);
    Route::post('/validate', [DepartmentController::class, 'validateElement']);
    Route::get('/them', [DepartmentController::class, 'create']);
    Route::get('/sua/{id}', [DepartmentController::class, 'edit']);
    Route::get('/xoa/{id}', [DepartmentController::class, 'destroy']);
    Route::post('/store', [DepartmentController::class, 'store']);
    Route::post('/update/{id}', [DepartmentController::class, 'update']);
    });
 //Product
 Route::group(['prefix'=>'/san-pham'],function (){
    Route::get('/danh-sach', [ProductController::class, 'index']);
    Route::post('/validate', [ProductController::class, 'validateElement']);
    Route::get('/them', [ProductController::class, 'create']);
    Route::get('/sua/{id}', [ProductController::class, 'edit']);
    Route::get('/xoa/{id}', [ProductController::class, 'destroy']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
    Route::post('/get-child-categories', [ProductController::class, 'getChildCategory']);
    });
 //Order
 Route::group(['prefix'=>'/hoa-don'],function (){
    Route::get('/danh-sach', [OrderController::class, 'index']);
    Route::post('/validate', [OrderController::class, 'validateElement']);
    Route::get('/them', [OrderController::class, 'create']);
    Route::get('/sua/{id}', [OrderController::class, 'edit']);
    Route::get('/xoa/{id}', [ProductController::class, 'destroy']);
    Route::get('/xoa-chi-tiet/{order_id}/{product_id}', [ProductController::class, 'destroyDetail']);
    Route::post('/store', [OrderController::class, 'store']);
    Route::post('/update/{id}', [OrderController::class, 'update']);
    Route::post('/show', [OrderController::class, 'show']);
    });
});