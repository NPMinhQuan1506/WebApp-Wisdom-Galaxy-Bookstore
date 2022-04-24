@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Hóa Đơn', 'tittleCRUD' => 'Thêm'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('public/backend/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/quill/dist/quill.snow.css')}}">
<link href="{{asset('public/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<style>

</style>
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row mb-lg-3">
        <div class="table-responsive col-lg-8">
            <table id="product-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>BarCode</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh</th>
                        <th style="width:200px !important;text-align: center;">Loại Sản Phẩm</th>
                        <th style="width:90px !important;text-align: center;">Số Lượng</th>
                        <th style="text-align: center">Đơn vị</th>
                        <th style="text-align: center">Giá Bán (VNĐ)</th>
                        <th style="width:120px !important;text-align: center;">Nhà Cung Cấp</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $row)
                    <tr>
                        <td style="width:20px !important;padding-left:25px">{{$row->barcode}}</td>
                        <td>{{$row->name}}</td>
                        <td><img class="card-img-bottom" src="https://docs.google.com/uc?id={{$row->path}}">
                        </td>
                        <td style="width:200px !important;text-align: center; vertical-align: middle">
                            @php
                            echo App\Http\Controllers\Admin\ProductController::getCategory($row->sku);
                            @endphp
                        </td>
                        <td style="width: 30px !important; text-align: center">
                            <input type="number" min="1" step="5" id="amount" name="amount"
                            class="form-control" placeholder="" value="0">
                        </td>
                        <td style="width: 30px !important; text-align: center">{{$row->unit}}</td>
                        <td style="width: 30px !important; text-align: center">
                            @php
                                echo number_format((float)$row->selling_price, 0, '', ',');
                            @endphp
                        </td>
                        <td>{{$row->supplier}}</td>
                        <td>
                            <button id="btnAddCart" name="btnAddCart" class="btn btn-facebook text-white"
                                onclick="">Thêm</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <div class="row" style="position: -webkit-sticky; position: fixed;z-index: 100;">
                <form id="frmProduct" name="frmProduct" enctype="multipart/form-data"
                    action="{{URL::to('/admin/hoa-don/store')}}" method="POST">
                    @csrf
                    <div class="card" style="">
                        <div class="card-body">
                            <h4 class="card-title">Thông Tin Đơn Hàng</h4>
                                <div class="form-group ">
                                    <input type="hidden" autocomplete="off" class="form-control" id="barcode" name="barcode"
                                        placeholder="" readonly>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="" disabled value="a">

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
<script src="{{asset('public/backend/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
{{--setup table--}}
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
     $(document).ready(function () {
        var table = $('#product-table').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json"
        },
        "scrollX": true,
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]],
        });
    });
</script>
{{--validate--}}
<script>
    var objNameList = "/";
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
@endsection