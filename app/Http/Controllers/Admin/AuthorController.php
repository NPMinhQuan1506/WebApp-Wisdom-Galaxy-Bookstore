<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class AuthorController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $authors = Author::all();

        return view('admin.author_list',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.author_add');
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
        $author = new Author();
        $author->name =  $request->name;
        $author->note =  $request->note;
        $author->save();

        return Redirect::to('/admin/tac-gia/danh-sach')->with("success","Thêm tác giả thành công");
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
        $author = Author::find($id);
        return view('admin.author_edit', compact('author'));
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
        $author = Author::find($id);
        $author->name =  $request->name;
        $author->note =  $request->note;
        $author->save();

        return Redirect::to('/admin/tac-gia/danh-sach')->with("success","Cập nhật tác giả thành công");
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
        $author = Author::find($id);
        $books = $author->product;
        if($books->count() > 0)
        {
            return Redirect::to('/admin/tac-gia/danh-sach')->with("error","Không thể xóa tác giả. Cần xóa các sách thuộc tác giả này");
        }
        else{
            $author->delete();
            return Redirect::to('/admin/tac-gia/danh-sach')->with("success","Xóa tác giả thành công");
        }


    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'name' => 'bail|required|regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/|unique:author,name',
            ],
            [
                'name.required' => 'Không được để trống tên tác giả',
                'name.regex' => 'Tên tác giả không có ký tự đặt biệt và số',
                'name.unique' => 'Tên tác giả đã tồn tại',
            ]
        );
    }
}
