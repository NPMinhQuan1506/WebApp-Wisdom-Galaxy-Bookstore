@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Khách Hàng', 'tittleCRUD' => 'Thêm'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/quill/dist/quill.snow.css')}}">
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row" style="margin-left: 15%;margin-right: 15%">
        <form id="frmCustomer" name="frmCustomer" enctype="multipart/form-data"
            action="{{URL::to('/admin/khach-hang/store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Tin Khách Hàng</h4>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label class="">Ảnh Đại Diện</label>
                            <div class="">
                                <div class="custom-file">
                                    <img id="img" src="#" alt="Ảnh của khách hàng"
                                        style="width: 100px; height: 100px;" />
                                    <br> <input type="file" class="custom-file-input" name="avatar"
                                        id="validatedCustomFile" accept=".jpg, .jpeg, .png" required
                                        onchange="readURL(this);">
                                    <div class="notify-exists">
                                    </div>
                                    <label class="custom-file-label" for="validatedCustomFile">Chọn Ảnh...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="name" class="text-end control-label col-form-label">Tên Khách Hàng</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" name="name"
                                placeholder="Nhập Tên Khách Hàng">
                            <div class="notify-exists">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label>Ngày Sinh</label>
                            <div class="input-group">
                                <input type="text" class="form-control mydatepicker" id="birth" autocomplete="off"
                                    name="birth" placeholder="mm/dd/yyyy">
                                <div class="input-group-append">
                                    <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="notify-date-exists">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="">Giới Tính</label>
                            <div class="">
                                <select class="form-select shadow-none" name="gender" id="gender"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Giới Tính</option>
                                    @foreach($genders as $gender)
                                    <option value='{{$gender->id}}'>{{$gender->gender}}</option>
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
                                <input type="text" class="form-control email-inputmask" id="email" name="cus_email"
                                    readonly onfocus="this.removeAttribute('readonly');" placeholder="Nhập Email">
                                <div class="notify-exists">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="phone" class="text-end control-label col-form-label">Số Điện Thoại <small
                                    class="text-muted">(099) 999-9999</small></label>
                            <div class="">
                                <input type="text" class="form-control phone-inputmask" id="phone" name="phone"
                                    placeholder="Nhập Số Điện Thoại">
                                <div class="notify-exists">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="account" class="text-end control-label col-form-label">Tài Khoản</label>
                            <input type="text" class="form-control" autocomplete="off" name="account" readonly
                                onfocus="this.removeAttribute('readonly');" id="account" placeholder="Nhập Tài Khoản">
                            <div class="notify-exists">
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="password" class="text-end control-label col-form-label">Mật Khẩu<small
                                    class="text-muted"> Ít nhất 8 ký tự (1 số, 1 chữ hoa và thường)</small></label>
                            <div class="">
                                <input type="password" class="form-control" autocomplete="off" name="password"
                                    id="passwd" placeholder="Nhập Mật Khẩu">
                                <div class="notify-exists">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="address" class="text-end control-label col-form-label">Địa Chỉ</label>
                            <input type="text" autocomplete="off" class="form-control" id="address" name="address"
                                placeholder="Nhập Địa Chỉ">
                            <div class="notify-exists">
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="">Loại Khách Hàng</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="customer_type" id="customer"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Loại Khách Hàng</option>
                                    @foreach($customer_types as $customer_type)
                                    <option value='{{$customer_type->id}}'>{{$customer_type->type}}</option>
                                    @endforeach
                                </select>
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
        validateInput(name);
        validateInput(address);
        validateInput(birth);
        validateInput(email);
        validateInput(phone);
        validateInput(account);
        validateInput(password);
        validateInput(avatar);
        handleSubmit();
    });
    function validateInput(obj) {
        obj.change(function (e) {
            var txtData = $(this).val();
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
                url: "../khach-hang/validate",
                data: $("#frmCustomer").serialize(),
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
        var valueCustomerType = $( "#customer_type option:selected" ).val();
        var valueGender = $( "#gender option:selected" ).val();
        if(valueGender == 0 || valueCustomerType == 0){
            return false;
        }
        return true;
    }
    function handleSubmit(){
        $('#btnSave').click(function (e) {
            e.preventDefault();
            var count = objNameList.split("/").length;
            if(count == 10  && validateSelect()){
                $( '#frmCustomer').submit();
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
<!--setup select-->
<script>
    //***********************************//
    // For select 2
    //***********************************//
    $(".select2").select2();

    /*colorpicker*/
    $('.demo').each(function () {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
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
    /*datepicker*/
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
                window.location.href='danh-sach';
                Swal.fire(
                'Thông báo!',
                'Dữ liệu không được lưu.',
                'success',
                )
            }
        })
    }
</script>
@endsection