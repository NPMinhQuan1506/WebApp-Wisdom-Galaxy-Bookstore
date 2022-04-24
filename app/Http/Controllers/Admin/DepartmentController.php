<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
class DepartmentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::all();

        return view('admin.department_list',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.department_add');
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
        $department = new Department();
        $department->name =  $request->name;
        $department->level =  $request->level;
        $department->note =  $request->note;
        $department->save();

        return Redirect::to('/admin/chuc-vu/danh-sach')->with("success","Thêm chức vụ thành công");
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
        $department = Department::find($id);
        return view('admin.department_edit', compact('department'));
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
        $department = Department::find($id);
        $department->name =  $request->name;
        $department->level =  $request->level;
        $department->note =  $request->note;
        $department->save();

        return Redirect::to('/admin/chuc-vu/danh-sach')->with("success","Cập nhật chức vụ thành công");
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
        $department = Department::find($id);
        $employees = $department->employee()->whereRaw('`employee`.`is_enable`=1');
        if($employees->count() > 0)
        {
            return Redirect::to('/admin/chuc-vu/danh-sach')->with("error","Không thể xóa chức vụ. Cần xóa các nhân viên thuộc chức vụ này");
        }
        else{
            $department->is_enable = 0;
            return Redirect::to('/admin/chuc-vu/danh-sach')->with("success","Xóa chức vụ thành công");
        }


    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'name' => 'bail|required|regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/|unique:department,name',
            ],
            [
                'name.required' => 'Không được để trống tên chức vụ',
                'name.regex' => 'Tên chức vụ không có ký tự đặt biệt và số',
                'name.unique' => 'Tên chức vụ đã tồn tại',
            ]
        );
    }
}
