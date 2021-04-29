@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Nhân Viên'])
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
        <form id="frmEmployee" name="frmEmployee" enctype="multipart/form-data"
            action="{{URL::to('/admin/nhan-vien/store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Tin Nhân Viên</h4>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="name" class="text-end control-label col-form-label">Tên Nhân Viên</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" name="name"
                                placeholder="Nhập Tên Nhân Viên">
                            <div class="notify-exists">
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label class="">Ảnh Đại Diện</label>
                            <div class="">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="avatar" id="validatedCustomFile"
                                        accept=".jpg, .jpeg, .png" required>
                                    <div class="notify-exists">
                                    </div>
                                    <label class="custom-file-label" for="validatedCustomFile">Chọn Ảnh...</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>
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
                                <input type="text" class="form-control email-inputmask" id="email" name="emp_email"
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
                            <label class="">Chức Vụ</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="department" id="department"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Chức Vụ</option>
                                    @foreach($departments as $department)
                                    <option value='{{$department->id}}'>{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="salary" class="text-end control-label col-form-label">Lương</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="number" min="100000" step="500000" id="salary" name="salary"
                                        class="form-control" value="100000" placeholder="100000"
                                        aria-label="Recipient 's username" id="salary" aria-describedby="basic-addon2">
                                    <div class="notify-exists">
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">VNĐ</span>
                                    </div>
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
                            <label class="text-end control-label col-form-label">Ngày Ký Hợp Đồng</label>
                            <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" id="datepicker-autoclose"
                                    name="hiredate" placeholder="mm/dd/yyyy" min='01/01/1920' max='12/31/2021'>
                                <div class="input-group-append">
                                    <span class="input-group-text h-100"><i class="fa fa-calendar"></i></span>
                                </div>
                                <div class="notify-date-exists">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button id="btnSave" name="btnSave" class="btn btn-success text-white">Lưu</button>
                            <button id="btnReset" name="btnReset" class="btn btn-primary">Đặt Lại</button>
                            <button id="btnCancel" name="btnCancel" class="btn btn-danger text-white">Hủy</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection
@section('js')
<script src="{{asset('resources/js/validationAdmin.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/pages/mask/mask.init.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/select2/dist/js/select2.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/jquery-minicolors/jquery.minicolors.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/quill/dist/quill.min.js')}}"></script>
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
    /*datwpicker*/
    jQuery('.mydatepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    //max Date
//     var today = new Date();
// var dd = today.getDate();
// var mm = today.getMonth()+1; //January is 0!
// var yyyy = today.getFullYear();
//  if(dd<10){
//         dd='0'+dd
//     }
//     if(mm<10){
//         mm='0'+mm
//     }

// today = mm+'/'+dd+'/';
// $('.datetime').attr("max", today);
</script>
@endsection