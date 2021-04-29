<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class AjaxController extends Controller
{
    //
    // public function checkExists(Request $request)
    // {
    //     $table_name = $request->table_name;
    //     $field_name = $request->field_name;
    //     $data = $request->data_field;
    //     $result = DB::table($table_name)->where($field_name, '=', $data)->get();
    //     if ($result->count() != 0) {
    //         $json_string = array("isValid"=>false,"notify"=>"Dữ Liệu Đã Tồn Tại");
    //         $myJSON = json_encode($json_string);
    //         echo $myJSON;
    //     } else {
    //         $json_string = array("isValid"=>true,"notify"=>"Dữ Liệu Hơp Lệ");
    //         $myJSON = json_encode($json_string);
    //         echo $myJSON;
    //     }
    // }
}
