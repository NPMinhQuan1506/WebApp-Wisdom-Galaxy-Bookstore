<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Models\CustomerType;
class CustomerTypeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer_types = CustomerType::all();

        return view('admin.customer_type_list',compact('customer_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.customer_type_add');
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
        $customer_type = new CustomerType();
        $customer_type->type =  $request->type;
        $customer_type->note =  $request->note;
        $customer_type->save();

        return Redirect::to('/admin/loai-khach-hang/danh-sach')->with("success","Thêm loại khách hàng thành công");
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
        $customer_type = CustomerType::find($id);
        return view('admin.customer_type_edit', compact('customer_type'));
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
        $customer_type = CustomerType::find($id);
        $customer_type->type =  $request->type;
        $customer_type->note =  $request->note;
        $customer_type->save();

        return Redirect::to('/admin/loai-khach-hang/danh-sach')->with("success","Cập nhật loại khách hàng thành công");
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
        $customer_type = CustomerType::find($id);
        $customers = $customer_type->customer;
        if($customers->count() > 0)
        {
            return Redirect::to('/admin/loai-khach-hang/danh-sach')->with("error","Không thể xóa loại khách hàng. Cần xóa các khách hàng thuộc loại này");
        }
        else{
            $customer_type->delete();
            return Redirect::to('/admin/loai-khach-hang/danh-sach')->with("success","Xóa loại khách hàng thành công");
        }


    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'type' => 'bail|required|regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/|unique:customer_type,type',
            ],
            [
                'type.required' => 'Không được để trống loại khách hàng',
                'type.regex' => 'Loại khách hàng không có ký tự đặt biệt và số',
                'type.unique' => 'Loại khách hàng đã tồn tại',
            ]
        );
    }
}
