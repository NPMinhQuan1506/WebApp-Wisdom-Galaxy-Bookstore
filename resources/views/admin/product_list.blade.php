@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Sản Phẩm'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/extra-libs/multicheck/multicheck.css')}}">
<link href="{{asset('public/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<style>
    img.card-img-bottom {
        width: 50px;
        height: 50px;
    }

    .border-top {
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .border-top div {
        margin-top: 10px;
    }

    .border-top .add-button {
        padding-left: 20px;
    }

    .border-top .hide-select {
        margin-left: 20%;
        margin-right: 2%;
    }

    .border-top select {
        width: 500px;
    }
</style>
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh Sách</h5>
                    <div class="border-top">
                        <div class="add-button">
                            <button id="btnAdd" name="btnAdd" class="btn btn-facebook text-white"
                                onclick="location.href = '{{URL::to('admin/san-pham/them')}}';">Thêm</button>
                        </div>
                        <div class="hide-select">
                            <label for="">Ẩn Các Cột: </label>
                            <select class="select2 form-select shadow-none" id="hide-column-sl" multiple="multiple"
                                style="height: 36px;">
                                <option value="3">Ảnh</option>
                                <option value="4">Loại Sản Phẩm</option>
                                <option value="5" >Số Lượng</option>
                                <option value="6" >Đơn Vị</option>
                                <option value="7" selected>Hàng Tồn Tối Thiểu</option>
                                <option value="8">Giá Bán</option>
                                <option value="9" selected>Phiên Bản</option>
                                <option value="10" >Nhà Cung Cấp</option>
                                <option value="11" selected>Nhà Xuất Bản</option>
                                <option value="12" selected>Tác Giả</option>
                            </select>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:20px !important;padding-left:25px">STT</th>
                                    <th>BarCode</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Loại Sản Phẩm</th>
                                    <th style="text-align: center">Số Lượng</th>
                                    <th style="text-align: center">Đơn vị</th>
                                    <th >Hàng Tồn Tối Thiểu</th>
                                    <th style="text-align: center">Giá Bán (VNĐ)</th>
                                    <th style="text-align: center">Phiên Bản</th>
                                    <th>Nhà Cung Cấp</th>
                                    <th>Nhà Xuất Bản</th>
                                    <th>Tác Giả</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $row)
                                <tr>
                                    <td style="width:20px !important;padding-left:25px"></td>
                                    <td style="width:20px !important;padding-left:25px">{{$row->barcode}}</td>
                                    <td>{{$row->name}}</td>
                                    <td><img class="card-img-bottom" src="https://docs.google.com/uc?id={{$row->path}}">
                                    </td>
                                    <td>
                                        @php
                                        echo App\Http\Controllers\Admin\ProductController::getCategory($row->sku);
                                        @endphp
                                    </td>
                                    <td style="width: 30px !important; text-align: center">{{$row->inventory_number}}</td>
                                    <td style="width: 30px !important; text-align: center">{{$row->unit}}</td>
                                    <td style="text-align: center">{{$row->min_inventory_number}}</td>
                                    <td style="width: 30px !important; text-align: center">
                                        @php
                                            echo number_format((float)$row->selling_price, 0, '', ',');
                                        @endphp
                                    </td>
                                    <td style="width: 30px !important; text-align: center">{{$row->edition}}</td>
                                    <td>{{$row->supplier}}</td>
                                    <td>{{$row->publisher}}</td>
                                    <td>
                                        @php
                                        echo App\Http\Controllers\Admin\ProductController::getAuthor($row->sku);
                                        @endphp
                                    </td>

                                    <td>
                                        <button id="btnEdit" name="btnEdit" class="btn btn-facebook text-white"
                                            onclick="window.location.href='sua/{{$row->sku}}'">Sửa</button>
                                    </td>
                                    <td>
                                        <button id="btnDelete" name="btnDelete" class="btn btn-danger text-white"
                                            onclick="confirmDeletion({{$row->sku}})">Xóa</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th style="width:20px !important;padding-left:25px">STT</th>
                                <th>BarCode</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Ảnh</th>
                                <th>Loại Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Đơn Vị</th>
                                <th>Hàng Tồn Tối Thiểu</th>
                                <th>Giá Bán</th>
                                <th>Phiên Bản</th>
                                <th>Nhà Cung Cấp</th>
                                <th>Nhà Xuất Bản</th>
                                <th>Tác Giả</th>
                                <th></th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{asset('public/backend/assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
<script src="{{asset('public/backend/assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
<script src="{{asset('public/backend/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('public/backend/assets/libs/select2/dist/js/select2.min.js')}}"></script>
{{--setup table--}}
<script>
    //search column
    $('#zero_config tfoot th').each( function () {
        var title = $(this).text();
        if(title != "Ảnh" && title != ""){
            switch(title){
                case "STT":
                $(this).html( '<input style="width: 70px;border: none; outline: none;" type="text" readonly placeholder="Lọc" />' );
                break;
                case "Số Lượng":
                $(this).html( '<input style="width: 90px;border: none; outline: none;" type="text" placeholder="'+title +'" />' );
                break;
                case "Đơn Vị":
                $(this).html( '<input style="width: 90px;border: none; outline: none;" type="text" placeholder="'+title +'" />' );
                break;
                case "Hàng Tồn Tối Thiểu":
                $(this).html( '<input style="width: 130px;border: none; outline: none;" type="text" placeholder="'+title +'" />' );
                break;
                case "Giá Bán":
                $(this).html( '<input style="width: 110px;border: none; outline: none;" type="text" placeholder="'+title +'" />' );
                break;
                case "Phiên Bản":
                $(this).html( '<input style="width: 80px;border: none; outline: none;" type="text" placeholder="'+title +'" />' );
                break;
                default:
                $(this).html( '<input style="border: none;" type="text" placeholder="'+title +'" />' );
                break;
            }

        }
       else{
        $(this).html( '<input style="display: none" type="text" placeholder="Nhập '+title +'" />' );
       }
    } );
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $(document).ready(function () {
        var table = $('#zero_config').DataTable({
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
        "initComplete": function( settings, json ) {
            var columnsHide = $( "#hide-column-sl").val();
                $.each(columnsHide, function (i, value) {
                    var column = table.column(value);
                     column.visible(false);
                });
                 // Apply the search
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });

    //index
    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
       //***********************************//
        // For select 2
        //***********************************//

        $(".select2").select2();
        //show/hide column
        $('#hide-column-sl').change(function (e) {
            e.preventDefault();
            var columnsHide = $( "#hide-column-sl").val();
            for(var i = 1; i <  $('#zero_config tfoot th').length; i++)
                {
                    var column = table.column(i);
                     column.visible(true);
                }
            if(columnsHide.length != 0){
                $.each(columnsHide, function (i, value) {
                    var column = table.column(value);
                     column.visible(false);
                });
            }
        });
    });
</script>
{{--setup message box--}}
<script>
    @if(Session::has('success'))
        Swal.fire({
                icon: 'success',
                title: 'Thành Công',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
                footer: '<a href>Xin Cảm Ơn!</a>'
              })
    @endif

    @if(Session::has('error'))
    Swal.fire({
                icon: 'error',
                title: 'Lỗi Dữ Liệu',
                text: '{{ session('error') }}',
                footer: '<a href>Xin Cảm Ơn!</a>'
              });
    @endif
    function confirmDeletion(id){
            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            title: 'Bạn có chắc không?',
            text: "Bạn sẽ không thể phục hồi dữ liệu!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có, xóa nó đi!',
            cancelButtonText: 'Không, hủy bỏ!',
            reverseButtons: true
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='xoa/'+id;
                swalWithBootstrapButtons.fire(
                'Đã xóa!',
                'Dữ liệu đã bị xóa.',
                'success'
                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Đã hủy',
                'Dữ liệu vẫn tồn tại :)',
                'error'
                )
            }
            })
    }
</script>
@endsection