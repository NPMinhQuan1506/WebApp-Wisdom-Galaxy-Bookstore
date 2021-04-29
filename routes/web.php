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

Route::get('put', function() {
    // $filename = "teo";
    // $filePath = public_path('frontend/images/OwlLogo.jpg');
    // $fileData = File::get($filePath);
    // Storage::disk('google')->put($filename, $fileData);
    // $filename = "teo1.png";
    // $dir = '/';
    // $recursive = false;
    // $contents = collect(Storage::listContents());
    // $file = $contents
    //     ->where('type', '=', 'file')
    //     ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
    //     ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
    //     ->first();

    // return $file['path'];
    // Storage::disk('google')->put('test1.txt', 'Hello World');
    // $filename = 'test.txt';
    // Tìm file và sử dụng ID (path) của nó để xóa
    // $googleDriveStorage = Storage::disk('google');

    // Đường dẫn tới thư mục muốn liệt kê nội dung
    // $dir = '/';
    // Hoặc có thể liệt kê trong một sub-folders
    // $dir = '/path-to-sub-folder'

    // Có đọc nội dung bên trong các sub-folder của $dir hay không?
    // Nên đặt là false để tránh phải liệt kê qua nhiều khi thư mục có nhiều file & sub-folders
    // Storage::disk('google')->put('a.txt', 'Hello World');
    // $recursive = false;
    // $contents = $googleDriveStorage->allFiles();
        // dd($contents);
        // $filename = 'teo1.png';

        // $dir = '/';
        // $recursive = false; // Get subdirectories also?
        // $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        // $file = $contents
        //     ->where('type', '=', 'file')
        //     ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        //     ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        //     ->first(); // there can be duplicate file names!

        // return $file; // array with file info

        // $rawData = Storage::cloud()->get($file['path']);

        // return response($rawData, 200)
        //     ->header('ContentType', $file['mimetype'])
        //     ->header('Content-Disposition', "attachment; filename='$filename'");
    // echo $googleDriveStorage->get($contents[0]);
        // header("Content-Type: image/jpg");
        // dd($googleDriveStorage->get("1NRoIRIVGHYgewCknErWbkKwXNJZqUc4w"));

        // $dir = '/';
        // $recursive = false; // Get subdirectories also?
        // $contents = collect(Storage::cloud()->directories($dir, $recursive));


        // Storage::cloud()->put($contents[0].'/test.txt', 'Hello World');

        // return 'File was created in the sub directory in Google Drive';
        // $filename = 'teo';
        // $dir = '/';
        // $recursive = false; // Có lấy file trong các thư mục con không?
        // $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        // $file = $contents
        //     ->where('type', '=', 'file')
        //     ->where('filename', '=', pathinfo($filename, PATHINFO_FILENAME))
        //     ->where('extension', '=', pathinfo($filename, PATHINFO_EXTENSION))
        //     ->first(); // có thể bị trùng tên file với nhau!
        // //return $file; // array with file info
        // $rawData = Storage::cloud()->get($file['path']);
        // return response($rawData, 200)
        //     ->header('Content-Type', $file['mimetype'])
        //     ->header('Content-Disposition', "attachment; filename='$filename'");
        // $dir = '/';
        // $recursive = false; // Get subdirectories also?
        // $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        // $dir = $contents->where('type', '=', 'dir')
        //     ->where('filename', '=', 'Employee')
        //     ->first(); // There could be duplicate directory names!

        // if ( ! $dir) {
        //     return 'Directory does not exist!';
        // }

        // Storage::cloud()->put($dir['path'].'/test.txt', 'Hello World');

        // return 'File was created in the sub directory in Google Drive';
    // foreach($contents as $content){
    //     print_r($content);
    // }
    // foreach($contents as $content){
    //     dd($googleDriveStorage->readStream($content));
    // }
    // dd($contents[count($contents)-1]);

    // $googleDriveStorage = Storage::disk('google');

    // $filePath = public_path('logo.png');
    // $fileData = File::get($filePath);
    // Storage::cloud()->put($filename, $fileData);
    // return 'File was saved to Google Drive';
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
