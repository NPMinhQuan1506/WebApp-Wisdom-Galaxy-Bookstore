@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Nhân Viên'])
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
                                onclick="location.href = '{{URL::to('admin/nhan-vien/them')}}';">Thêm</button>
                        </div>
                        <div class="hide-select">
                            <label for="">Ẩn Các Cột: </label>
                            <select class="select2 form-select shadow-none" id="hide-column-sl" multiple="multiple"
                                style="height: 36px;">
                                <option value="1">Tên Nhân Viên</option>
                                <option value="2">Ảnh</option>
                                <option value="3">Tuổi</option>
                                <option value="4">Giới Tính</option>
                                <option value="5">Email</option>
                                <option value="6">SĐT</option>
                                <option value="7">Tài Khoản</option>
                                <option value="8">Chức Vụ</option>
                                <option value="9">Lương</option>
                                <option value="10">Ngày Ký Hợp Đồng</option>
                                <option value="11">Địa Chỉ</option>
                            </select>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered" >
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Nhân Viên</th>
                                    <th>Ảnh</th>
                                    <th>Tuổi</th>
                                    <th>Giới Tính</th>
                                    <th>Email</th>
                                    <th style="width: 150px !important">SĐT</th>
                                    <th>Tài Khoản</th>
                                    <th>Chức Vụ</th>
                                    <th>Lương</th>
                                    <th>Ngày Ký Hợp Đồng</th>
                                    <th>Địa Chỉ</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $row)
                                <tr>
                                    <td style="padding-left:25px"></td>
                                    <td>{{$row->name}}</td>
                                    <td><img class="card-img-bottom" src="https://docs.google.com/uc?id={{$row->path}}">
                                    </td>
                                    <td>{{$row->date_of_birth}}</td>
                                    <td>{{$row->gender}}</td>
                                    <td>{{$row->email}}</td>
                                    <td style="width: 150px !important">{{$row->phone}}</td>
                                    <td>{{$row->username}}</td>
                                    <td>{{$row->department}}</td>
                                    <td>{{$row->salary}}</td>
                                    <td>{{$row->hire_date}}</td>
                                    <td>{{$row->address}}</td>
                                    <td><button id="btnEdit" name="btnEdit" class="btn btn-facebook text-white"
                                            onclick="location.href = '{{URL::to('admin/nhan-vien/sua')}}';">Sửa</button>
                                    </td>
                                    <td><button id="btnDelete" name="btnDelete" class="btn btn-danger text-white"
                                            onclick="location.href = '{{URL::to('admin/nhan-vien/xoa')}}';">Xóa</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>STT</th>
                                <th>Tên Nhân Viên</th>
                                <th>Ảnh</th>
                                <th>Tuổi</th>
                                <th>Giới Tính</th>
                                <th>Email</th>
                                <th style="width: 150px !important">SĐT</th>
                                <th>Tài Khoản</th>
                                <th>Chức Vụ</th>
                                <th>Lương</th>
                                <th>Ngày Ký Hợp Đồng</th>
                                <th>Địa Chỉ</th>
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
<script>
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
        "order": [[ 1, 'asc' ]]
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
            for(var i = 1; i <  $('#zero_config tfoot th').length-2; i++)
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

    //search column
        $('#zero_config tfoot th').each( function () {
        var title = $(this).text();
        if(title != "Ảnh"){
            $(this).html( '<input style="border: none; outline: none;" type="text" placeholder="Lọc Theo '+title +'" />' );
        }
       else{
        $(this).html( '<input style="display: none" type="text" placeholder="Nhập '+title +'" />' );
       }
        } );
    });
</script>
@endsection