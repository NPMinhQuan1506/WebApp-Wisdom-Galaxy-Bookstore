@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Nhân Viên'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/extra-libs/multicheck/multicheck.css')}}">
<link href="{{asset('public/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
@endsection
@section('content_admin')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Basic Datatable</h5>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>
                                        <label class="customcheckbox mb-3">
                                            <input type="checkbox" id="mainCheckbox" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <th>Tên Nhân Viên</th>
                                    <th>Ảnh</th>
                                    <th>Ngày Sinh</th>
                                    <th>Giới Tính</th>
                                    <th>Email</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Tài Khoản</th>
                                    <th>Chức Vụ</th>
                                    <th>Lương</th>
                                    <th>Ngày Ký Hợp Đồng</th>
                                    <th>Địa Chỉ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>
                                        <label class="customcheckbox">
                                            <input type="checkbox" class="listCheckbox" />
                                            <span class="checkmark"></span>
                                        </label>
                                    </th>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>2011/04/25</td>
                                    <td>$320,800</td>
                                </tr>
                            </tbody>
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
<script>
    /****************************************
     *       Basic Table                   *
     ****************************************/
    $('#zero_config').DataTable();
</script>
@endsection