<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Core\GoogleDriverController;
use App\Models\CusAccount;
use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customers = DB::select('select c.id, c.name, c.date_of_birth, c.email, c.phone, c.address,
        a.username, ct.type as customer_type, g.gender,  i.path
        from `customer` as c
        inner join `cus_account` as a on `c`.`account_id` = `a`.`id`
        inner join `customer_type` as ct on `c`.`customer_type_id` = `ct`.`id`
        inner join `gender` as g on `c`.`gender_id` = `g`.`id`
        inner join `image` as i on `c`.`image_id` = `i`.`id`
        where `c`.`is_enable` = 1
        order by `c`.`id` asc');

        return view('admin.customer_list',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customer_types = CustomerType::all();
    	$genders = Gender::all();
        return view('admin.customer_add', compact('customer_types','genders'));
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
        $googleDriver = new GoogleDriverController();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = date('d-m-Y H:i:s')."_Customer_".$request->name."_".$file->getClientOriginalName();
            $fileName = preg_replace('/\-|\s|\:/', '_', $fileName);
            $extensionFile = $file->getClientOriginalExtension();
            $googleDriver->uploadFileInFolder("Customer", $fileName, $file->getContent());
            $path = $googleDriver->getFileId("Customer" ,$fileName);
        }
        //
        $account = new CusAccount();
        $account->username =  $request->account;
        $account->password =  bcrypt($request->password);
        $account->save();
        $account_id =$account->where('username', $request->account)->first()->id;
        $cus_avatar = new Image();
        if(isset($path)){
            $cus_avatar->path = $path;
        }
        if(isset($extensionFile)){
        $cus_avatar->extension = $extensionFile;
        }
        $cus_avatar->save();
        if(isset($path)){
        $image_id =$cus_avatar->where('path', $path)->first()->id;
        }
        $customer = new Customer();
        $customer->name = $request->name;
        $originalDate = $request->birth;
        $date_of_birth = date("Y-m-d", strtotime($originalDate));
        $customer->date_of_birth = $date_of_birth;
        $customer->gender_id = $request->gender;
        $customer->account_id = $account_id;
        if(isset($path)){
            $customer->image_id = $image_id;
        }
        $customer->email = $request->cus_email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->customer_type_id = $request->customer_type;
        $customer->save();
        return Redirect::to('/admin/khach-hang/danh-sach')->with("success","Thêm khách hàng thành công");
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
        $customer = Customer::find($id);
        $account = $customer->account;
        $image = $customer->image;
        $customer_types = CustomerType::all();
    	$genders = Gender::all();

        return view('admin.customer_edit', compact('customer','account','image','customer_types','genders'));
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
        $googleDriver = new GoogleDriverController();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = date('d-m-Y H:i:s')."Customer".$request->name."_".$file->getClientOriginalName();
            $fileName = preg_replace('/\-|\s|\:/', '_', $fileName);
            $extensionFile = $file->getClientOriginalExtension();
            $googleDriver->uploadFileInFolder("Customer", $fileName, $file->getContent());
            $path = $googleDriver->getFileId("Customer" ,$fileName);
        }
        //
        $customer = Customer::find($id);
        $account = CusAccount::find($customer->account_id);
        $cus_avatar = Image::find($customer->image_id);

        $account->username =  $request->account;
        if($request->has('isPassword')){
            //Checkbox checked
            $account->password =  bcrypt($request->password);
        }
        $account->save();
        $account_id =$account->where('username', $request->account)->first()->id;
        if(isset($path)){
        $cus_avatar->path = $path;
        }
        if(isset($extensionFile)){
        $cus_avatar->extension = $extensionFile;
        }
        $cus_avatar->save();
        if(isset($image_id)){
        $image_id =$cus_avatar->where('path', $path)->first()->id;
        }
        $customer->name = $request->name;
        $originalDate = $request->birth;
        $date_of_birth = date("Y-m-d", strtotime($originalDate));
        $customer->date_of_birth = $date_of_birth;
        $customer->gender_id = $request->gender;
        $customer->customer_type_id = $request->customer_type;
        $customer->account_id = $account_id;
        if(isset($image_id)){
            $customer->image_id = $image_id;
        }
        $customer->email = $request->cus_email;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();

        return Redirect::to('/admin/khach-hang/danh-sach')->with("success","Cập nhật khách hàng thành công");
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
        $customer = Customer::find($id);
        $account = CusAccount::find($customer->account_id);
        $image = Image::find($customer->image_id);
        $order = $customer->order()->whereRaw('`order`.`is_enable`=1');
        if($order->count() > 0)
        {
            return Redirect::to('/admin/khach-hang/danh-sach')->with("error","Không thể xóa khách hàng. Cần xóa các đơn hàng có khách hàng này");
        }
        else{
        $customer->is_enable = 0;
        $account->is_enable = 0;
        $image->is_enable = 0;
        $customer->save();
        $account->save();
        $image->save();
        return Redirect::to('/admin/khach-hang/danh-sach')->with("success","Xóa khách hàng thành công");
        }
    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'name' => 'bail|required|regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/',
                'address' => 'required',
                'avatar' => 'image',
                'birth' => 'required|date_format:m/d/Y',
                'gender' => 'required',
                'cus_email' => 'required|regex:/^[_A-Za-z0-9-\+]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$/|unique:customer,email',
                'phone' => 'bail|required|regex:/\(0[0-9]{2}\)(\s?[0-9]{3})(\-[0-9]{4})/|unique:customer,phone', //not_regex:/[_]/
                'account' => 'bail|required|regex:/^[A-Za-z0-9]+(?:[ _@-][A-Za-z0-9]+)*$/|unique:cus_account,username',
                'password' => 'bail|required|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{8,}$/',
            ],
            [
                'avatar.image' => 'Tệp tải lên phải là có đuôi: jpeg, png, bmp, gif, svg.',
                'name.required' => 'Không được để trống tên',
                'name.regex' => 'Tên không có ký tự đặt biệt và số',
                'address.required' => 'Không được để trống địa chỉ',
                'birth.required' => 'Không được để trống ngày sinh',
                'birth.date_format' => 'Ngày sinh phải có dạng m/d/Y',
                'gender.required' => 'Không được để trống giới tính',
                'cus_email.required' => 'Không được để trống email',
                'cus_email.regex' => 'Không đúng định dạng email',
                'cus_email.unique' => 'Email đã tồn tại',
                'phone.required' => 'Không được để trống điện thoại',
                'phone.regex' => 'Điện thoại phải có 10 chữ số bắt đầu bằng số 0',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'account.required' => 'Không được để trống tài khoản',
                'account.regex' => 'Tài khoản không có ký tự đặt biệt ngoại trừ [_-]',
                'account.unique' => 'Tài khoản đã tồn tại',
                'password.required' => 'Không được để trống password',
                'password.regex' => 'Password chỉ có chữ hoa hoặc chữ thường và số. Ít nhất 8 ký tự',
            ]
        );
    }
}
