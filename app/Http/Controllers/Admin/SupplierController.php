<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::all();

        return view('admin.supplier_list',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.supplier_add');;
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
        $supplier= new Supplier();
        $supplier->name =  $request->name;
        $supplier->phone =  $request->phone;
        $supplier->email =  $request->sup_email;
        $supplier->address =  $request->address;
        $supplier->save();
        return Redirect::to('/admin/nha-cung-cap/danh-sach')->with("success","Thêm nhà cung cấp thành công");
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
        $supplier = Supplier::find($id);
        return view('admin.supplier_edit', compact('supplier'));
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
        $supplier= Supplier::find($id);
        $supplier->name =  $request->name;
        $supplier->phone =  $request->phone;
        $supplier->email =  $request->sup_email;
        $supplier->address =  $request->address;
        $supplier->save();

        return Redirect::to('/admin/nha-cung-cap/danh-sach')->with("success","Sửa nhà cung cấp thành công");
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
        $supplier = Supplier::find($id);
        $products = $supplier->product;
        $imports = $supplier->import;
        if($products->count() > 0)
        {
            return Redirect::to('/admin/nha-cung-cap/danh-sach')->with("error","Không thể xóa nhà cung cấp. Cần xóa các sản phẩm thuộc nhà cung cấp này");
        }
        else if($imports->count() > 0){
            return Redirect::to('/admin/nha-cung-cap/danh-sach')->with("error","Không thể xóa nhà cung cấp. Cần xóa các phiếu nhập thuộc nhà cung cấp này");
        }
        else{
            $supplier->delete();
            return Redirect::to('/admin/nha-cung-cap/danh-sach')->with("success","Xóa nhà cung cấp thành công");
        }
    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'name' => 'bail|required|regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/|unique:supplier,name',
                'address' => 'required',
                'sup_email' => 'required|regex:/^[_A-Za-z0-9-\+]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$/|unique:supplier,email',
                'phone' => 'bail|required|regex:/\(0[0-9]{2}\)(\s?[0-9]{3})(\-[0-9]{4})/|unique:supplier,phone', //not_regex:/[_]/
            ],
            [
                'name.required' => 'Không được để trống tên',
                'name.unique' => 'Tên nhà cung cấp đã tồn tại',
                'name.regex' => 'Tên không có ký tự đặt biệt và số',
                'address.required' => 'Không được để trống địa chỉ',
                'sup_email.required' => 'Không được để trống email',
                'sup_email.regex' => 'Không đúng định dạng email',
                'sup_email.unique' => 'Email đã tồn tại',
                'phone.required' => 'Không được để trống điện thoại',
                'phone.regex' => 'Điện thoại phải có 10 chữ số bắt đầu bằng số 0',
                'phone.unique' => 'Số điện thoại đã tồn tại',
            ]
        );
    }
}
