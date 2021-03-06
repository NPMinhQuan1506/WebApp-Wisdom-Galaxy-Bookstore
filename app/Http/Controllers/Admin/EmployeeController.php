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
        return Redirect::to('/admin/nhan-vien/danh-sach')->with("success","Th??m nh??n vi??n th??nh c??ng");
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

        return Redirect::to('/admin/nhan-vien/danh-sach')->with("success","C???p nh???t nh??n vi??n th??nh c??ng");
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
            return Redirect::to('/admin/nhan-vien/danh-sach')->with("error","Kh??ng th??? x??a nh??n vi??n. C???n x??a c??c ????n h??ng v?? ????n nh???p h??ng c?? nh??n vi??n n??y");
        }

        $employee->is_enable = 0;
        $account->is_enable = 0;
        $image->is_enable = 0;
        $employee->save();
        $account->save();
        $image->save();
        return Redirect::to('/admin/nhan-vien/danh-sach')->with("success","X??a nh??n vi??n th??nh c??ng");
    }
    public function validateElement(Request $request)
    {
        $request->validate(
            [
                'name' => 'bail|required|regex:/^[a-zA-Z_????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????\s]+$/',
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
                'avatar.image' => 'T???p t???i l??n ph???i l?? c?? ??u??i: jpeg, png, bmp, gif, svg.',
                'name.required' => 'Kh??ng ???????c ????? tr???ng t??n',
                'name.regex' => 'T??n kh??ng c?? k?? t??? ?????t bi???t v?? s???',
                'address.required' => 'Kh??ng ???????c ????? tr???ng ?????a ch???',
                'birth.required' => 'Kh??ng ???????c ????? tr???ng ng??y sinh',
                'birth.date_format' => 'Ng??y sinh ph???i c?? d???ng m/d/Y',
                'gender.required' => 'Kh??ng ???????c ????? tr???ng gi???i t??nh',
                'emp_email.required' => 'Kh??ng ???????c ????? tr???ng email',
                'emp_email.regex' => 'Kh??ng ????ng ?????nh d???ng email',
                'emp_email.unique' => 'Email ???? t???n t???i',
                'phone.required' => 'Kh??ng ???????c ????? tr???ng ??i???n tho???i',
                'phone.regex' => '??i???n tho???i ph???i c?? 10 ch??? s??? b???t ?????u b???ng s??? 0',
                'phone.unique' => 'S??? ??i???n tho???i ???? t???n t???i',
                'account.required' => 'Kh??ng ???????c ????? tr???ng t??i kho???n',
                'account.regex' => 'T??i kho???n kh??ng c?? k?? t??? ?????t bi???t ngo???i tr??? [_-]',
                'account.unique' => 'T??i kho???n ???? t???n t???i',
                'password.required' => 'Kh??ng ???????c ????? tr???ng password',
                'password.regex' => 'Password ch??? c?? ch??? hoa ho???c ch??? th?????ng v?? s???. ??t nh???t 8 k?? t???',
                'department.required' => 'Kh??ng ???????c ????? tr???ng ch???c v???',
                'salary.required' => 'Kh??ng ???????c ????? tr???ng l????ng',
                'salary.alpha_num' => 'L????ng c?? d???ng s???',
                'hiredate.required' => 'Kh??ng ???????c ????? tr???ng ng??y k?? h???p ?????ng',
                'hiredate.date_format' => 'Ng??y k?? h???p ?????ng ph???i c?? d???ng m/d/Y',
            ]
        );
    }
}
