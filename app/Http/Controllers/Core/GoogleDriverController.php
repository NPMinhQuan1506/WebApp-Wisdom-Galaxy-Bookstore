<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;

class GoogleDriverController extends Controller
{
    //
    public function uploadFile($fileName, $fileData)
    {
        Storage::cloud()->put($fileName, $fileData);
    }
    public function uploadFileInFolder($folderName, $fileName, $fileData)
    {
        $dir = '/';
        $recursive = false; // Get subdirectories also?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folderName)
            ->first(); // There could be duplicate directory names!
        if (!$dir) {
            return 'Thư Mục Không Tồn Tại!';
        }
        $existenceFile = $this->checkExistenceFile($folderName, $fileName);
        if ( $existenceFile  == 0) {
            Storage::cloud()->put($dir['path'] . '/' . $fileName, $fileData);
        }
        else{
            $fileName = str_replace(".","(".$existenceFile.").", $fileName);
            Storage::cloud()->put($dir['path'] . '/' . $fileName, $fileData);
        }
        return true;
    }
    public function deleteFile($fileName)
    {
        // Tìm file và sử dụng ID (path) của nó để xóa
        $dir = '/';
        $recursive = true; //  Có lấy file trong các thư mục con không?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($fileName, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($fileName, PATHINFO_EXTENSION))
            ->first(); // có thể bị trùng tên file với nhau!
        if (!$file) {
            return 'File Không Tồn Tại!';
        }
        Storage::cloud()->delete($file['path']);
        return true;
    }

    public function getFileId($folderName, $fileName)
    {
        $dir = '/';
        $recursive = true; //  Có lấy file trong các thư mục con không?
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));
        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folderName)
            ->first(); // There could be duplicate directory names!
        if (!$dir) {
            return 'Thư Mục Không Tồn Tại!';
        }
        $file = $contents
            ->where('type', '=', 'file')
            ->where('filename', '=', pathinfo($fileName, PATHINFO_FILENAME))
            ->where('extension', '=', pathinfo($fileName, PATHINFO_EXTENSION))
            ->first(); // có thể bị trùng tên file với nhau!
        if (!$file) {
            return 'File Không Tồn Tại!';
        }
        $service = Storage::cloud()->getAdapter()->getService();
        $permission = new \Google_Service_Drive_Permission();
        $permission->setRole('reader');
        $permission->setType('anyone');
        $permission->setAllowFileDiscovery(false);
        $permissions = $service->permissions->create($file['basename'], $permission);
        return $file['basename'];
    }

    public function getAllFile()
    {
        $dir = '/';
        $recursive = false;
        $contents = collect(Storage::cloud()->listContents($dir, $recursive));

        return $contents->where('type', '=', 'file');
    }

    public function getAllFileIdInFolder($folderName)
    {
        $contents = collect(Storage::cloud()->listContents('/', false));

        $dir = $contents->where('type', '=', 'dir')
            ->where('filename', '=', $folderName)
            ->first();

        if (!$dir) {
            return 'No such folder!';
        }

        $files = collect(Storage::cloud()->listContents($dir['path'], false))
            ->where('type', '=', 'file');

        return $files->mapWithKeys(function ($file) {
            $filename = $file['filename'] . '.' . $file['extension'];
            $path = $file['path'];

            return [$filename => $path];
        });
    }

    public function checkExistenceFile($folderName, $fileName)
    {
    $contents = collect(Storage::cloud()->listContents('/', false));
    $dir = $contents->where('type', '=', 'dir')
        ->where('filename', '=', $folderName)
        ->first();

    if ( ! $dir) {
        return 'No such folder!';
    }
    $fileName = preg_replace('/\(\d{1,}\)/', '', $fileName);
    // $fileName = str_replace("\(\d{1,}\)","", $fileName);
    $files = collect(Storage::cloud()->listContents($dir['path'], false))
        ->where('type', '=', 'file')
        ->where('filename', '=', pathinfo($fileName, PATHINFO_FILENAME))
        ->where('extension', '=', pathinfo($fileName, PATHINFO_EXTENSION));
        if(! $files) {
            return 0;
        }
        return count($files);
    }
}
