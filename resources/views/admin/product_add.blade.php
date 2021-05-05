@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Sản Phẩm', 'tittleCRUD' => 'Thêm'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/quill/dist/quill.snow.css')}}">
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row" style="margin-left: 10%;margin-right: 10%">
        <form id="frmProduct" name="frmProduct" enctype="multipart/form-data"
            action="{{URL::to('/admin/khach-hang/store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Tin Sản Phẩm</h4>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label class="">Ảnh Sản Phẩm</label>
                            <div class="">
                                <div class="custom-file">
                                    <img id="img" src="#" alt="Ảnh của sản phẩm" style="width: 100px; height: 100px;" />
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
                            <label for="barcode" class="text-end control-label col-form-label">Barcode</label>
                            <input type="text" autocomplete="off" class="form-control" id="barcode" name="barcode"
                                placeholder="Nhập Barcode">
                            <div class="notify-exists">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="name" class="text-end control-label col-form-label">Tên Sản Phẩm</label>
                            <input type="text" autocomplete="off" class="form-control" id="name" name="name"
                                placeholder="Nhập Tên Sản Phẩm">
                            <div class="notify-exists">
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="selling_price" class="text-end control-label col-form-label">Giá Bán</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="number" min="1000" step="5000" id="selling_price" name="selling_price"
                                        class="form-control" placeholder="Nhập Giá Bán"
                                        aria-label="Recipient 's username" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">VNĐ</span>
                                    </div>
                                    <div class="notify-exists"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" style="height: 100px">
                        <div class="form-group col-lg-7">
                            <div class="row mb-3">
                                <div class="form-group col-lg-6">
                                    <label for="category" class="">Loại Sản Phẩm</label>
                                    <div class="">
                                        <select class="select2 form-select shadow-none" name="category" id="category"
                                            style="width: 100%; height:36px;">
                                            <option value="0">Chọn Loại Sản Phẩm</option>
                                            @foreach($categories as $category)
                                            <option value='{{$category->id}}'>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="group_genre" class="">Nhóm Thể Loại</label>
                                    <div class="">
                                        <select class="select2 form-select shadow-none" name="group_genre"
                                            id="group_genre" style="width: 100%; height:36px;">
                                            <option value="0">Chọn Nhóm Thể Loại</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="genre" class="">Thể Loại</label>
                            <select class="select2 form-select shadow-none" name="genre" id="genre" multiple="multiple"
                                style="width: 100%; height:36px;">
                                <option value="0">Chọn Thể Loại</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="inventory_number" class="text-end control-label col-form-label">Số Lượng</label>
                            <div class="">
                                <div class="row mb-3">
                                    <div class="col-lg-9">
                                        <input type="number" min="1" step="5" id="inventory_number"
                                            name="inventory_number" class="form-control" value=""
                                            placeholder="Nhập Số Lượng" aria-label="Recipient 's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <div class="col-lg-3">
                                        <select class="form-select shadow-none" name="unit" id="unit"
                                            style="width: 100%; height:36px;">
                                            <option value='cái'>cái</option>
                                            <option value='quyển'>quyển</option>
                                            <option value='lô'>lô</option>
                                            <option value='hộp'>hộp</option>
                                        </select>
                                    </div>
                                    <div class="notify-exists valid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="min_inventory_number" class="text-end control-label col-form-label">Số Lượng Tồn
                                Tối Thiểu</label>
                            <div class="">
                                <div class="row mb-3">
                                    <div class="">
                                        <input type="number" min="100" step="5" id="min_inventory_number"
                                            name="min_inventory_number" class="form-control" value=""
                                            placeholder="Nhập Số Lượng Tối Thiểu" aria-label="Recipient 's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <div class="notify-exists valid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="supplier" class="">Nhà Cung Cấp</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="supplier" id="supplier"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Nhà Cung Cấp</option>
                                    @foreach($suppliers as $supplier)
                                    <option value='{{$supplier->id}}'>{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="edition" class="text-end control-label col-form-label">Phiên Bản</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="number" min="1" step="1" id="edition" name="edition"
                                        class="form-control" value="1" placeholder="100000"
                                        aria-label="Recipient 's username" aria-describedby="basic-addon2">
                                    {{-- <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="author" class="">Tác Giả</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="author" id="author"
                                    multiple="multiple" style="width: 100%; height:36px;">
                                    <option value="0">Chọn Tác Giả</option>
                                    @foreach($authors as $author)
                                    <option value='{{$author->id}}'>{{$author->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="publisher" class="">Nhà Xuất Bản</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="publisher" id="publisher"
                                    style="width: 100%; height:36px;">
                                    <option value="0">Chọn Nhà Xuất Bản</option>
                                    @foreach($publishers as $publisher)
                                    <option value='{{$publisher->id}}'>{{$publisher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button id="btnSave" name="btnSave" class="btn btn-success text-white">Lưu</button>
                            <button id="btnReset" type="reset" name="btnReset" class="btn btn-primary">Đặt Lại</button>
                            <button id="btnCancel" type="button" name="btnCancel" class="btn btn-danger text-white"
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
        var barcode = $("#barcode");
        var inventory_number = $("#inventory_number");
        var selling_price = $("#selling_price");
        validateInput(avatar);
        validateInput(name);
        validateInput(barcode);
        validateInput(inventory_number);
        validateInput(selling_price);
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
                url: "../san-pham/validate",
                data: $("#frmProduct").serialize(),
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
        var valueCategory = $( "#category option:selected" ).val();
        var valueUnit = $( "#unit option:selected" ).val();
        var valueSupplier = $( "#supplier option:selected" ).val();
        var valuePublisher = $( "#publisher option:selected" ).val();
        var valueAuthor = $( "#author option:selected" ).val();
        if(valueCategory == 0 || valueUnit == 0 || valueSupplier == 0 || valuePublisher == 0 || valueAuthor == 0){
            return false;
        }
        return true;
    }
    function handleSubmit(){
        $('#btnSave').click(function (e) {
            e.preventDefault();
            var count = objNameList.split("/").length;
            if(count == 7  && validateSelect()){
                $( '#frmProduct').submit();
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
    // $(".select2").select2();
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
{{--setup ajax load data of group genre and genre select ctr--}}
<script>
    $(document).ready(function () {
        var category = $('#category');
        var group_genre = $('#group_genre');
        loadChildNested(category);
        loadChildNested(group_genre);
    });
    function loadChildNested(obj){
        obj.change(function (e) {
        e.preventDefault();
            var id = obj.find(":selected").val();
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            });
            $.ajax({
                type: "POST",
                url: "../san-pham/get-child-categories",
                data: {'id':id},
                dataType: "json",
                processData: true,
                success: function (data) {
                    if(obj.attr('name')=="category")
                    {
                        $('#genre').empty();
                        $('#genre').append('<option value="0">Chọn Thể Loại</option>');
                        var selectNext = $('#group_genre');
                        selectNext.empty();
                        selectNext.append('<option value="0">Chọn Nhóm Thể Loại</option>');
                    }
                    else if(obj.attr('name')=="group_genre")
                    {
                        var selectNext = $('#genre');
                        selectNext.empty();
                        selectNext.append('<option value="0">Chọn Thể Loại</option>');
                    }

                    for (var i = 0; i < data.length; i++) {
                        selectNext.append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                    }
                },
                error: function (xhr, textStatus, errorThrown) { console.log(textStatus + ':' + errorThrown); }
            });
        });
    }
</script>
@endsection