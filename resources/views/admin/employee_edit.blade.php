@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Nhân Viên', 'tittleCRUD' => 'Sửa'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/quill/dist/quill.snow.css')}}">
<link href="{{asset('public/backend/dist/css/style.min.css')}}" rel="stylesheet">
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row" style="margin-left: 15%;margin-right: 15%">
        <form id="frmEmployee" name="frmEmployee" enctype="multipart/form-data" action="../update/{{ $employee->id }}"
            method="POST">
            {{-- @method('PATCH') --}}
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Tin Nhân Viên</h4>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label class="">Ảnh Đại Diện</label>
                            <div class="">
                                <div class="custom-file">
                                    <img id="img" src="https://docs.google.com/uc?id={{$image->path}}"
                                        alt="Ảnh của nhân viên" style="width: 100px; height: 100px;">
                                    <br> <input type="file" class="custom-file-input is-valid" name="avatar"
                                        id="validatedCustomFile" accept=".jpg, .jpeg, .png" required
                                        onchange="readURL(this);" value="{{$image->path}}">
                                    <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                                    <label class="custom-file-label" for="validatedCustomFile">Chọn Ảnh...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="name" class="text-end control-label col-form-label">Tên Nhân Viên</label>
                            <input type="text" autocomplete="off" class="form-control is-valid" id="name" name="name"
                                placeholder="Nhập Tên Nhân Viên" value="{{$employee->name}}">
                            <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label>Ngày Sinh</label>
                            <div class="input-group">
                                <input type="text" class="form-control mydatepicker is-valid" id="birth"
                                    autocomplete="off" name="birth" placeholder="mm/dd/yyyy"
                                    value="{{$employee->date_of_birth}}">
                                <div class="input-group-append">
                                    <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="">Giới Tính</label>
                            <div class="">
                                <select class="form-select shadow-none" name="gender" id="gender"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Giới Tính</option>
                                    @foreach($genders as $gender)
                                    <option value='{{$gender->id}}' @if ($employee->gender_id == $gender->id)
                                        selected="selected"
                                        @endif
                                        >{{$gender->gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label class="text-end control-label col-form-label">Email<small class="text-muted">
                                    abc@gmail.com</small></label>
                            <div class="">
                                <input type="text" class="form-control email-inputmask is-valid" id="email"
                                    name="emp_email" readonly onfocus="this.removeAttribute('readonly');"
                                    placeholder="Nhập Email" value="{{$employee->email}}">
                                <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="phone" class="text-end control-label col-form-label">Số Điện Thoại <small
                                    class="text-muted">(099) 999-9999</small></label>
                            <div class="">
                                <input type="text" class="form-control phone-inputmask is-valid" id="phone" name="phone"
                                    placeholder="Nhập Số Điện Thoại" value="{{$employee->phone}}">
                                <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="account" class="text-end control-label col-form-label is-valid">Tài
                                Khoản</label>
                            <input type="text" class="form-control" autocomplete="off" name="account" readonly
                                onfocus="this.removeAttribute('readonly');" id="account" placeholder="Nhập Tài Khoản"
                                value="{{$account->username}}">
                            <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="password" class="text-end control-label col-form-label">Mật Khẩu<small
                                    class="text-muted"> Ít nhất 8 ký tự (1 số, 1 chữ hoa và thường)</small></label>
                            <div class="">
                                <input type="password" class="form-control" autocomplete="off" name="password"
                                    id="passwd" placeholder="Nhập Mật Khẩu Reset" value="Admin123456" readonly>
                                <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                            </div>
                            {{-- pretty checkbox --}}
                            <div class="pretty p-svg p-plain p-bigger p-jelly">
                                <input type="checkbox" name="isPassword" id="ckb-password" />
                                <div class="state">
                                    <span class="svg">
                                        <i data-feather="check-square"></i>
                                    </span>
                                    <label>Bạn có muốn thay đổi mật khẩu?
                                    </label>
                                </div>
                            </div>
                            <p> <small class="text-muted"> Mật Khẩu Mặc Định "Admin123456"</small></p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label class="">Chức Vụ</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="department" id="department"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Chức Vụ</option>
                                    @foreach($departments as $department)
                                    <option value='{{$department->id}}' @if ($employee->department_id ==
                                        $department->id)
                                        selected="selected"
                                        @endif
                                        >{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="salary" class="text-end control-label col-form-label">Lương</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="number" min="100000" step="500000" id="salary" name="salary"
                                        class="form-control is-valid" value="100000" placeholder="100000"
                                        aria-label="Recipient 's username" id="salary" aria-describedby="basic-addon2"
                                        value="{{$employee->salary}}">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">VNĐ</span>
                                    </div>
                                    <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="address" class="text-end control-label col-form-label">Địa Chỉ</label>
                            <input type="text" autocomplete="off" class="form-control is-valid" id="address"
                                name="address" placeholder="Nhập Địa Chỉ" value="{{$employee->address}}">
                            <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="text-end control-label col-form-label">Ngày Ký Hợp Đồng</label>
                            <div class="input-group">
                                <input type="text" class="form-control is-valid" autocomplete="off"
                                    id="datepicker-autoclose" name="hiredate" placeholder="mm/dd/yyyy" min='01/01/1920'
                                    max='12/31/2021' value="{{$employee->hire_date}}">
                                <div class="input-group-append">
                                    <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button id="btnSave" name="btnSave" class="btn btn-success text-white">Lưu</button>
                            <button id="btnReset" type="reset" name="btnReset" class="btn btn-primary">Đặt Lại</button>
                            <button id="btnCancel"  type="button" name="btnCancel" class="btn btn-danger text-white"
                                onclick="confirmCancel()">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
@section('js')
<script src="{{asset('public/backend/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/pages/mask/mask.init.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/jquery-minicolors/jquery.minicolors.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/quill/dist/quill.min.js')}}"></script>
{{--validate--}}
<script>
    var objNameList = "/";
    $(document).ready(function () {
        var avatar = $("#validatedCustomFile")
        var name = $("#name");
        var address = $("#address");
        var birth = $("#birth");
        var email = $("#email");
        var phone = $("#phone");
        var account = $("#account");
        var password = $("#passwd");
        var salary = $("#salary");
        var hiredate = $("#datepicker-autoclose");
        objNameList = objNameList + avatar.attr("name") + "/"
        + name.attr("name") + "/"
        + address.attr("name") + "/"
        + birth.attr("name") + "/"
        + email.attr("name") + "/"
        + phone.attr("name") + "/"
        + account.attr("name") + "/"
        + salary.attr("name") + "/"
        + password.attr("name") + "/"
        + hiredate.attr("name") + "/";
        validateInput(name);
        validateInput(address);
        validateInput(birth);
        validateInput(email);
        validateInput(phone);
        validateInput(account);
        validateInput(password);
        validateInput(salary);
        validateInput(hiredate);
        validateInput(avatar);
        handleSubmit();
    });
    function validateInput(obj) {
        obj.change(function (e) {
            // var txtData = $(this).val();
            var name = obj.attr("name");
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "../validate",
                data: $("#frmEmployee").serialize(),
                dataType: "json",
                error: function (Xhr, json, error) {
                    if(obj.next().is('.notify-exists')) {
                        var notify_data = obj.next();
                    }
                    else{
                        var notify_data =obj.next().next();
                    }
                    var errors = Xhr.responseJSON;
                    if(typeof errors !== "undefined")
                    {
                        var x = errors["errors"][name];
                    }


                    if (typeof x !== "undefined") {
                        checkIsValidClass(notify_data, "valid-feedback");
                        checkIsValidClass(obj, "is-valid");
                        obj.addClass("is-invalid");
                        notify_data.addClass("invalid-feedback");
                        notify_data.html(x);
                        // /a/b/b/
                        if(objNameList.includes(name)){
                            objNameList = objNameList.replace(name+"/","");
                        }
                    } else {
                        checkIsValidClass(notify_data, "invalid-feedback");
                        checkIsValidClass(obj, "is-invalid");
                        obj.addClass("is-valid");
                        notify_data.addClass("valid-feedback");
                        notify_data.html("Dữ Liệu Hợp Lệ");
                        if(!objNameList.includes(name)){
                            objNameList =  objNameList.concat(name+"/");
                        }
                    }
                },
            });
        });
    }
    function validateSelect(){
        var valueDepartment = $( "#department option:selected" ).val();
        var valueGender = $( "#gender option:selected" ).val();
        if(valueGender == 0 || valueDepartment == 0){
            return false;
        }
        return true;
    }
    function handleSubmit(){
        $('#btnSave').click(function (e) {
            e.preventDefault();
            var count = 0;
            var list = (objNameList.split("/")) ;
            $.each(list, function (index, value) {
                if(value.trim() === "password"){
                    if ($('#ckb-password').is(':checked')) {
                        count++;
                    }
                }
                else{
                    count++;
                }
            });
            var limitNameList = 0;
            if ($('#ckb-password').is(':checked')) {
                limitNameList=12;
            }
            else{
                limitNameList = 11;
            }
            if(count == limitNameList  && validateSelect()){
                $( '#frmEmployee').submit();
            }
            else{
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi Dữ Liệu Nhập',
                    text: 'Vui Lòng Kiểm Tra và Nhập Đúng Các Thuộc Tính!',
                    footer: '<a href>Xin Cảm Ơn!</a>'
                })
            }
        });
    }
    function checkIsValidClass(obj, classname) {
        if (obj.hasClass(classname)) {
            obj.removeClass(classname);
            return;
        }
        if (obj.hasClass(classname)) {
            obj.removeClass(classname);
            return;
        }
    }
</script>
{{--setup select--}}
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $('.demo').each(function () {
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            position: $(this).attr('data-position') || 'bottom left',

            change: function (value, opacity) {
                if (!value) return;
                if (opacity) value += ', ' + opacity;
                if (typeof console === 'object') {
                    console.log(value);
                }
            },
            theme: 'bootstrap'
        });

    });
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
       //show avatar image
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img')
                        .attr('src', e.target.result)
                        .width(100)
                        .height(100);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
{{--setup warning message when cancel--}}
<script>
    function confirmCancel(){
        Swal.fire({
            title: 'Bạn có chắc chứ?',
            text: "Tất cả dữ liệu nhập sẽ không được lưu!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Hủy!',
            confirmButtonText: 'Đúng, không lưu!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='../danh-sach';
                Swal.fire(
                'Thông báo!',
                'Dữ liệu không được lưu.',
                'success',
                )
            }
        })
    }
</script>
{{-- setup checkbox password --}}
<script>
    $('#ckb-password').click(function() {
    var notify_passwd = $('#passwd').next();
  if ($(this).is(':checked')) {
    $('#passwd').removeAttr("readonly");
    if(notify_passwd.hasClass("invalid-feedback"))
    {
        $('#passwd').addClass("is-invalid");
    }
    else if(notify_passwd.hasClass("valid-feedback"))
    {
        $('#passwd').addClass("is-valid");
    }
  }
  else{
      $('#passwd').attr("readonly", true);
      if($('#passwd').hasClass("is-invalid"))
      {
        $('#passwd').removeClass("is-invalid");
      }
      else if($('#passwd').hasClass("is-valid"))
      {
        $('#passwd').removeClass("is-valid");
      }
  }
    });


</script>
{{-- setup pretty svg icon  --}}
<script>
    feather.replace();
</script>
@endsection