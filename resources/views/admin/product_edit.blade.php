@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Sản Phẩm', 'tittleCRUD' => 'Sửa'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/quill/dist/quill.snow.css')}}">
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row" style="margin-left: 10%;margin-right: 10%">
        <form id="frmProduct" name="frmProduct" enctype="multipart/form-data" action="../update/{{ $product->sku }}"
            method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông Tin Sản Phẩm</h4>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label class="">Ảnh Sản Phẩm</label>
                            <div class="">
                                <div class="custom-file">
                                    <img id="img" src="https://docs.google.com/uc?id={{$image->path}}"
                                        alt="Ảnh của sản phẩm" style="width: 100px; height: 100px;" />
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
                            <label for="barcode" class="text-end control-label col-form-label">Barcode<small
                                    class="text-muted">
                                    Ít nhất 10 ký tư( số, chữ hoa, chữ thường)</small></label>
                            <input type="text" autocomplete="off" class="form-control is-valid" id="barcode"
                                name="barcode" placeholder="Nhập Barcode" value="{{$product->barcode}}">
                            <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="name" class="text-end control-label col-form-label">Tên Sản Phẩm</label>
                            <input type="text" autocomplete="off" class="form-control is-valid" id="name" name="name"
                                placeholder="Nhập Tên Sản Phẩm" value="{{$product->name}}">
                            <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="selling_price" class="text-end control-label col-form-label">Giá Bán</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="number" min="1000" step="5000" id="selling_price" name="selling_price"
                                        class="form-control is-valid" placeholder="Nhập Giá Bán"
                                        aria-label="Recipient 's username" aria-describedby="basic-addon2"
                                        value="{{$product->selling_price}}">
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
                            <select class="select2 form-select shadow-none" name="genre[]" id="genre"
                                multiple="multiple" style="width: 100%; height:36px;">
                                <option value="0" disabled>Chọn Thể Loại</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="inventory_number" class="text-end control-label col-form-label">Số Lượng</label>
                            <div class="">
                                <div class="input-group">

                                    <input type="number" min="1" step="5" id="inventory_number" name="inventory_number"
                                        class="form-control" placeholder="Nhập Số Lượng"
                                        aria-label="Recipient 's username" aria-describedby="basic-addon2" readonly
                                        value="{{$product->inventory_number}}">

                                    <div class="input-group-append" style="width: 20%;">
                                        <select class="form-select shadow-none input-group-text" name="unit" id="unit"
                                            style="width: 100%; height:36px;">
                                            <option value='cái' @if ($product->unit == 'cái')
                                                selected="selected"
                                                @endif
                                                >cái</option>
                                            <option value='quyển' @if ($product->unit == 'quyển')
                                                selected="selected"
                                                @endif
                                                >quyển</option>
                                            <option value='lô' @if ($product->unit == 'lô')
                                                selected="selected"
                                                @endif
                                                >lô</option>
                                            <option value='hộp' @if ($product->unit == 'hộp')
                                                selected="selected"
                                                @endif
                                                >hộp</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="min_inventory_number" class="text-end control-label col-form-label">Số Lượng Tồn
                                Tối Thiểu</label>
                            <div class="">
                                <input type="number" min="100" step="5" max="220" id="min_inventory_number"
                                    name="min_inventory_number" class="form-control is-valid"
                                    placeholder="Nhập Số Lượng Tối Thiểu" aria-label="Recipient 's username"
                                    aria-describedby="basic-addon2" value="{{$product->min_inventory_number}}">
                                <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div>
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
                                    <option value='{{$supplier->id}}' @if ($product->supplier_id == $supplier->id)
                                        selected="selected"
                                        @endif
                                        >{{$supplier->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-lg-5">
                            <label for="edition" class="text-end control-label col-form-label">Phiên Bản</label>
                            <div class="">
                                <div class="input-group">
                                    <input type="number" min="1" step="1" max="20" id="edition" name="edition"
                                        class="form-control" value="1" placeholder="100000"
                                        aria-label="Recipient 's username" aria-describedby="basic-addon2" value="@isset($product_detail->editon)
                                        $product_detail->editon
                                        @endisset">
                                    {{-- <div class="notify-exists valid-feedback">Dữ Liệu Hợp Lệ</div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group col-lg-7">
                            <label for="author" class="">Tác Giả</label>
                            <div class="">
                                <select class="select2 form-select shadow-none" name="author[]" id="author"
                                    multiple="multiple" style="width: 100%; height:36px;">
                                    @foreach($authors as $author)
                                    <option value='{{$author->id}}' @isset($product_author) @foreach ($product_author as
                                        $row) @if ($row->id == $author->id)
                                        selected="selected"
                                        @endif
                                        @endforeach
                                        @endisset
                                        >{{$author->name}}</option>
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
                                    <option value='{{$publisher->id}}' @isset($product_detail) @if ($product_detail->
                                        publisher_id == $publisher->id)
                                        selected = "selected"
                                        @endif
                                        @endisset
                                        >{{$publisher->name}}</option>
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
    var objNameList = "/avatar/name/barcode/min_inventory_number/selling_price/";
    $(document).ready(function () {
        var avatar = $("#validatedCustomFile")
        var name = $("#name");
        var barcode = $("#barcode");
        var min_inventory_number = $("#min_inventory_number");
        var selling_price = $("#selling_price");
        validateInput(avatar);
        validateInput(name);
        validateInput(barcode);
        validateInput(min_inventory_number);
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
                url: "../validate",
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
    function validateCategory(){
        var countOption =  $("#genre option").length;
        var valueCategory = $( "#category option:selected" ).val();
        var valueGroupGenre = $( "#group_genre option:selected" ).val();
        var valueGenre = $( "#genre option:selected" ).val();
        if(valueCategory == 0 || valueGroupGenre == 0){
            return false;
        }
        else{
            if(countOption != 1 && valueGenre == 0){
               return false;
            }
        }
        return true;
    }
    function validateSelect(){
        var valueCategory = $( "#category option:selected" ).val();
        var valueUnit = $( "#unit option:selected" ).val();
        var valueSupplier = $( "#supplier option:selected" ).val();
        var valuePublisher = $( "#publisher option:selected" ).val();
        var valueAuthor = $( "#author option:selected" ).val();
        if(valueUnit == 0 || valueSupplier == 0 || valuePublisher == 0 || valueAuthor == 0){
            return false;
        }
        return true;
    }
    function handleSubmit(){
        $('#btnSave').click(function (e) {
            e.preventDefault();
            var count = objNameList.split("/").length;
            if(count == 7  && validateSelect() && validateCategory()){
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
        showCategory();
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
                url: "../get-child-categories",
                data: {'id':id},
                dataType: "json",
                processData: true,
                success: function (data) {
                    if(obj.attr('name')=="category")
                    {
                        $('#genre').empty();
                        $('#genre').append('<option value="0" disabled>Chọn Thể Loại</option>');
                        var selectNext = $('#group_genre');
                        selectNext.empty();
                        selectNext.append('<option value="0">Chọn Nhóm Thể Loại</option>');
                        var valueSelect =  obj.find(":selected").text();
                        if(valueSelect.includes("Sách ")){
                            $('#author').prop('disabled', false);
                            $('#publisher').prop('disabled', false);
                            $("#unit option[value='quyển']").attr('selected', true);
                            $("#unit option[value='cái']").attr('disabled', true);
                            $("#unit option[value='hộp']").attr('disabled', true);
                            $("#unit option[value='quyển']").removeAttr('disabled');
                            $("#unit option[value='lô']").removeAttr('disabled');
                        }
                        else{
                            $('#author').val("0");
                            $('#publisher').val("0");
                            $("#select2-publisher-container").text("");
                            $("ul.select2-selection__rendered li:not(:last-child)").remove();
                            $('#author').prop('disabled', true);
                            $('#publisher').prop('disabled', true);
                            $("#unit option[value='cái']").removeAttr('disabled');
                            $("#unit option[value='hộp']").removeAttr('disabled');
                            $("#unit option[value='quyển']").attr('disabled', true);
                            $("#unit option[value='lô']").removeAttr('disabled');
                        }
                    }
                    else if(obj.attr('name')=="group_genre")
                    {
                        var selectNext = $('#genre');
                        selectNext.empty();
                        selectNext.append('<option value="0" disabled>Chọn Thể Loại</option>');
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
{{--loaddata product_category--}}
<script>
    function showCategory () {

        var category_list  = {!! json_encode($category_path) !!};
        var category = category_list[0][0]['id'];
        var group_genre = category_list[0][1]['id'];
        var genre = [];
        for(var i = 0; i < category_list.length ; i++){
            if(category_list[i][2]['id'] !== "undefined")
            {
                genre.push(category_list[i][2]['id']);
            }
        }
        $('#category').val(category).change();
        setTimeout(function(){
            $('#group_genre').val(group_genre).change();
        }, 800);

        if(genre.length != 0){
            setTimeout(function(){
                $('#genre').val(genre).change();
        }, 1200);
        }
    };
</script>
@endsection