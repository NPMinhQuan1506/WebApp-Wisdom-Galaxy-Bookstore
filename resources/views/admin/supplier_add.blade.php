@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Nhà Cung Cấp', 'tittleCRUD' => 'Thêm'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/quill/dist/quill.snow.css')}}">
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row" style="margin-left: 22%;margin-right: 22%">
        <form id="frmSupplier" name="frmSupplier" enctype="multipart/form-data"
            action="{{URL::to('/admin/nha-cung-cap/store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Tin Nhà Cung Cấp</h4>
                        <div class="form-group">
                            <label for="name" class="text-end control-label col-form-label">Tên Nhà Cung Cấp</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" name="name"
                                placeholder="Nhập Tên Nhà Cung Cấp">
                            <div class="notify-exists">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="text-end control-label col-form-label">Số Điện Thoại <small
                                    class="text-muted">(099) 999-9999</small></label>
                            <div class="">
                                <input type="text" class="form-control phone-inputmask" id="phone" name="phone"
                                    placeholder="Nhập Số Điện Thoại">
                                <div class="notify-exists">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-end control-label col-form-label">Email<small class="text-muted">
                                    abc@gmail.com</small></label>
                            <div class="">
                                <input type="text" class="form-control email-inputmask" id="email" name="sup_email"
                                    readonly onfocus="this.removeAttribute('readonly');" placeholder="Nhập Email">
                                <div class="notify-exists">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="text-end control-label col-form-label">Địa Chỉ</label>
                            <input type="text" autocomplete="off" class="form-control" id="address" name="address"
                                placeholder="Nhập Địa Chỉ">
                            <div class="notify-exists">
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
        var name = $("#name");
        var address = $("#address");
        var email = $("#email");
        var phone = $("#phone");
        validateInput(name);
        validateInput(address);
        validateInput(email);
        validateInput(phone);
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
                url: "../nha-cung-cap/validate",
                data: $("#frmSupplier").serialize(),
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
    function handleSubmit(){
        $('#btnSave').click(function (e) {
            e.preventDefault();
            var count = objNameList.split("/").length;
            if(count == 6){
                $( '#frmSupplier').submit();
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