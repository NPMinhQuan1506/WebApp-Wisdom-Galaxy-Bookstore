<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmpAccount;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Core\GoogleDriverController;
use App\Models\Department;
use App\Models\Gender;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EmployeeController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = DB::select('select e.id, e.name, e.date_of_birth, e.email, e.phone, e.address, e.salary, e.hire_date,
        a.username, d.name as department, g.gender,  i.path
        from `employee` as e
        inner join `emp_account` as a on `e`.`account_id` = `a`.`id`
        inner join `department` as d on `e`.`department_id` = `d`.`id`
        inner join `gender` as g on `e`.`gender_id` = `g`.`id`
        inner join `image` as i on `e`.`image_id` = `i`.`id`
        where `e`.`is_enable` = 1
        order by `e`.`id` asc');

        return view('admin.employee_list',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $departments = Department::all();
    	$genders = Gender::all();
        return view('admin.employee_add', compact('departments','genders'));
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
            $fileName = date('d-m-Y H:i:s')."_Employee_".$request->name."_".$file->getClientOriginalName();
            $fileName = preg_replace('/\-|\s|\:/', '_', $fileName);
            $extensionFile = $file->getClientOriginalExtension();
            $googleDriver->uploadFileInFolder("Employee", $fileName, $file->getContent());
            $path = $googleDriver->getFileId("Employee" ,$fileName);
        }
        //
        $account = new EmpAccount();
        $account->username =  $request->account;
        $account->password =  bcrypt($request->password);
        $account->save();
        $account_id =$account->where('username', $request->account)->first()->id;
        $emp_avatar = new Image();
        if(isset($path)){
            $emp_avatar->path = $path;
        }
        if(isset($extensionFile)){
        $emp_avatar->extension = $extensionFile;
        }
        $emp_avatar->save();
        if(isset($path)){
        $image_id =$emp_avatar->where('path', $path)->first()->id;
        }
        $employee = new Employee();
        $employee->name = $request->name;
        $originalDate = $request->birth;
        $date_of_birth = date("Y-m-d", strtotime($originalDate));
        $employee->date_of_birth = $date_of_birth;
        $employee->gender_id = $request->gender;
        $employee->department_id = $request->department;
        $employee->account_id = $account_id;
        if(isset($path)){
            $employee->image_id = $image_id;
        }
        $employee->email = $request->emp_email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $originalDate = $request->hiredate;
        $hiredate = date("Y-m-d", strtotime($originalDate));
        $employee->hire_date = $hiredate;
        $employee->save();
        return Redirect::to('/admin/nhan-vien/danh-sach')->with("success","Thêm nhân viên thành công");
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
        $employee = Employee::find($id);
        $account = $employee->account;
        $image = $employee->image;
        $departments = Department::all();
    	$genders = Gender::all();

        return view('admin.employee_edit', compact('employee','account','image','departments','genders'));
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
            $fileName = date('d-m-Y H:i:s')."_Employee_".$request->name."_".$file->getClientOriginalName();
            $fileName = preg_replace('/\-|\s|\:/', '_', $fileName);
            $extensionFile = $file->getClientOriginalExtension();
            $googleDriver->uploadFileInFolder("Employee", $fileName, $file->getContent());
            $path = $googleDriver->getFileId("Employee" ,$fileName);
        }
        //
        $employee = Employee::find($id);
        $account = EmpAccount::find($employee->account_id);
        $emp_avatar = Image::find($employee->image_id);

        $account->username =  $request->account;
        if($request->has('isPassword')){
            //Checkbox checked
            $account->password =  bcrypt($request->password);
        }
        $account->save();
        $account_id =$account->where('username', $request->account)->first()->id;
        if(isset($path)){
        $emp_avatar->path = $path;
        }
        if(isset($extensionFile)){
        $emp_avatar->extension = $extensionFile;
        }
        $emp_avatar->save();
        if(isset($image_id)){
        $image_id =$emp_avatar->where('path', $path)->first()->id;
        }
        $employee->name = $request->name;
        $originalDate = $request->birth;
        $date_of_birth = date("Y-m-d", strtotime($originalDate));
        $employee->date_of_birth = $date_of_birth;
        $employee->gender_id = $request->gender;
        $employee->department_id = $request->department;
        $employee->account_id = $account_id;
        if(isset($image_id)){
            $employee->image_id = $image_id;
        }
        $employee->email = $request->emp_email;
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->salary = $request->salary;
        $originalDate = $request->hiredate;
        $hiredate = date("Y-m-d", strtotime($originalDate));
        $employee->hire_date = $hiredate;
        $employee->save();

        return Redirect::to('/admin/nhan-vien/danh-sach')->with("success","Cập nhật nhân viên thành công");
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
        $employee = Employee::find($id);
        $account = EmpAccount::find($employee->account_id);
        $image = Image::find($employee->image_id);
        $order = $employee->order()->whereRaw('`order`.`is_enable`=1');
        $import = $employee->import()->whereRaw('`import`.`is_enable`=1');
        if($order->count() > 0 || $import->count() > 0)
        {
            return Redirect::to('/admin/nhan-vien/danh-sach')->with("error","Không thể xóa nhân viên. Cần xóa các đơn hàng và đơn nhập hàng có nhân viên này");
        }

        $employee->is_enable = 0;
        $account->is_enable = 0;
        $image->is_enable = 0;
        $employee->save();
        $account->save();
        $image->save();
        return Redirect::to('/admin/nhan-vien/danh-sach')->with("success","Xóa nhân viên thành công");
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
                'emp_email' => 'required|regex:/^[_A-Za-z0-9-\+]+(\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\.[A-Za-z0-9]+)*(\.[A-Za-z]{2,})$/|unique:employee,email',
                'phone' => 'bail|required|regex:/\(0[0-9]{2}\)(\s?[0-9]{3})(\-[0-9]{4})/|unique:employee,phone', //not_regex:/[_]/
                'account' => 'bail|required|regex:/^[A-Za-z0-9]+(?:[ _@-][A-Za-z0-9]+)*$/|unique:emp_account,username',
                'password' => 'bail|required|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=\S+$).{8,}$/',
                'department' => 'required',
                'salary' => 'required|alpha_num',
                'hiredate' => 'required|date_format:m/d/Y',
            ],
            [
                'avatar.image' => 'Tệp tải lên phải là có đuôi: jpeg, png, bmp, gif, svg.',
                'name.required' => 'Không được để trống tên',
                'name.regex' => 'Tên không có ký tự đặt biệt và số',
                'address.required' => 'Không được để trống địa chỉ',
                'birth.required' => 'Không được để trống ngày sinh',
                'birth.date_format' => 'Ngày sinh phải có dạng m/d/Y',
                'gender.required' => 'Không được để trống giới tính',
                'emp_email.required' => 'Không được để trống email',
                'emp_email.regex' => 'Không đúng định dạng email',
                'emp_email.unique' => 'Email đã tồn tại',
                'phone.required' => 'Không được để trống điện thoại',
                'phone.regex' => 'Điện thoại phải có 10 chữ số bắt đầu bằng số 0',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'account.required' => 'Không được để trống tài khoản',
                'account.regex' => 'Tài khoản không có ký tự đặt biệt ngoại trừ [_-]',
                'account.unique' => 'Tài khoản đã tồn tại',
                'password.required' => 'Không được để trống password',
                'password.regex' => 'Password chỉ có chữ hoa hoặc chữ thường và số. Ít nhất 8 ký tự',
                'department.required' => 'Không được để trống chức vụ',
                'salary.required' => 'Không được để trống lương',
                'salary.alpha_num' => 'Lương có dạng số',
                'hiredate.required' => 'Không được để trống ngày ký hợp đồng',
                'hiredate.date_format' => 'Ngày ký hợp đồng phải có dạng m/d/Y',
            ]
        );
    }
}
