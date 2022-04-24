<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class PublisherController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publishers = Publisher::all();

        return view('admin.publisher_list',compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.publisher_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        //
        $publisher = new Publisher();
        $publisher->name =  $request->name;
        $publisher->note =  $request->note;
        $publisher->save();

        return Redirect::to('/admin/nha-xuat-ban/danh-sach')->with("success","Thêm nhà xuất bản thành công");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $publisher = Publisher::find($id);
        return view('admin.publisher_edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $publisher = Publisher::find($id);
        $publisher->name =  $request->name;
        $publisher->note =  $request->note;
        $publisher->save();

        return Redirect::to('/admin/nha-xuat-ban/danh-sach')->with("success","Cập nhật nhà xuất bản thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $publisher = Publisher::find($id);
        $books = $publisher->product()->whereRaw('`product`.`is_enable`=1');
        if($books->count() > 0)
        {
            return Redirect::to('/admin/nha-xuat-ban/danh-sach')->with("error","Không thể xóa nhà xuất bản. Cần xóa các sách thuộc nhà xuất bản này");
        }
        else{
            $publisher->delete();
            return Redirect::to('/admin/nha-xuat-ban/danh-sach')->with("success","Xóa nhà xuất bản thành công");
        }


    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'name' => 'bail|required|regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/|unique:publisher,name',
            ],
            [
                'name.required' => 'Không được để trống tên nhà xuất bản',
                'name.regex' => 'Tên nhà xuất bản không có ký tự đặt biệt và số',
                'name.unique' => 'Tên nhà xuất bản đã tồn tại',
            ]
        );
    }
}
