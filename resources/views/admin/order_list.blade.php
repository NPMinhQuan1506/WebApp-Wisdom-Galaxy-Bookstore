@extends('templates.admin_master' , ['tittlePage' => 'Danh Mục Hóa Đơn'])
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/extra-libs/multicheck/multicheck.css')}}">
<link href="{{asset('public/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/libs/select2/dist/css/select2.min.css')}}">
<link href="https://editor.datatables.net/extensions/Editor/css/editor.dataTables.min.css" rel="stylesheet" type="text/css" />
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

    td.details-control {
        text-align: center;
        color: #00003b;
        font-size: 1.5em;
        cursor: pointer;
    }

    tr.shown td.details-control {
        text-align: center;
        font-size: 1.5em;
        color: rgb(200, 39, 39);
    }

    .order-detail-dt {}
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
                                onclick="location.href = '{{URL::to('admin/hoa-don/them')}}';">Thêm</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="width:20px !important;text-align: center">STT</th>
                                    <th style="width:40px !important;text-align: center">Mã Hóa Đơn</th>
                                    <th style="text-align: center">Nhân Viên</th>
                                    <th style="text-align: center">Khách Hàng</th>
                                    <th style="text-align: center">Tổng Số Lượng</th>
                                    <th style="text-align: center">Tổng Tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $row)
                                <tr>

                                    <td style="text-align: center; vertical-align: middle" class="details-control"><i
                                            class="fa fa-plus-circle" aria-hidden="true"></i></td>
                                    <td style="width:20px !important;text-align:center; vertical-align: middle"></td>
                                    <td style="width:100px; text-align: center; vertical-align: middle">{{$row->id}}
                                    </td>
                                    <td style="text-align: center; vertical-align: middle">{{$row->employee}}</td>
                                    <td style="text-align: center; vertical-align: middle">{{$row->customer}}</td>
                                    <td style="width:120px;text-align: center; vertical-align: middle">
                                        {{$row->total_amount}}</td>
                                    <td style="width:100px;text-align: center; vertical-align: middle">
                                        @php
                                        echo number_format((float)$row->total_payment, 0, '', ',');
                                        @endphp
                                    </td>

                                    <td>
                                        <button id="btnDelete" name="btnDelete" class="btn btn-danger text-white"
                                            onclick="confirmDeletion({{$row->id}})">Xóa</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr style="border-top: 1px solid">
                                    <th colspan="3" style="text-align:right;"></th>
                                    <th colspan="2" style="text-align:right; ;"></th>
                                </tr>
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
<script src="{{asset('public/backend/dist/js/jquery.number.min.js')}}"></script>
<script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
{{--setup table--}}
<script>
    //search column

    /****************************************

     *       Basic Table                   *
     ****************************************/
     var childEditors = {};
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
            "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
                'Tổng: ' + $.number(pageTotal,'',',') +' VNĐ' +' ( '+ $.number(total,'',',') +' VNĐ tổng)'
            );
        }
        });
        //child row - order item
        $('#zero_config tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
             var tdi = tr.find("i.fa");
             var row = table.row(tr);
             var rowData = row.data();

             if (row.child.isShown()) {
                 // This row is already open - close it
                 row.child.hide();
                 tr.removeClass('shown');
                 tdi.first().removeClass('fa-minus-circle');
                 tdi.first().addClass('fa-plus-circle');
                  $('#' +'item-' +rowData[2]).DataTable().destroy();
             }
             else {
                 // Open this row
                //  alert(row.data()[2]);
                 row.child(format(rowData)).show();
                 var id = 'item-' +rowData[2];
                $('#' + id).DataTable({
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
                 tr.addClass('shown');
                 tdi.first().removeClass('fa-plus-circle');
                 tdi.first().addClass('fa-minus-circle');
             }
    } );
        //index
        table.on( 'order.dt search.dt', function () {
            table.column(1, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
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

        // $('td.number').number( true, 2 );
    });

    function format ( rowData ) {
    // `d` is the original data object for the row
    var orderDetailContent = " ";
    $.ajax({
        type: "POST",
        async: false,
        url: "./show",
        data: {'id': rowData[2]},
        dataType: "json",
        processData: true,
        success: function (data) {
            if(data.length == 0){
                orderDetailContent += '<p> Không có hóa đơn chi tiết </p>';
            }
            else
            {
                orderDetailContent +=  '<h3>Chi Tiết Hóa Đơn</h3>'+
                '<table class="table table-striped table-bordered" id="' +'item-' +rowData[2]+ '" cellpadding="5" cellspacing="0">'+
                '<thead >'+
                    '<tr>'+
                        '<th style="width: 50px !important;text-align: center;">STT</th>'+
                        '<th style="text-align: center">Sản Phẩm</th>'+
                        '<th style="text-align: center">Giá Bán</th>'+
                        '<th style="text-align: center">Số Lượng</th>'+
                        '<th style="text-align: center">Đơn Vị Tính</th>'+
                        '<th style="text-align: center">Tổng Tiền</th>'+
                        '<th></th>'+
                    '</tr>'+
                '</thead>'+
                '<tbody>';
                        for (var i = 0; i < data.length; i++) {
                        orderDetailContent +='<tr>'+
                        '<td style="width: 50px !important;text-align:center; vertical-align: middle">'+ (i+1) + '</td>'+
                        '<td style="text-align: center; vertical-align: middle">'+data[i].pro_name+'</td>'+
                        '<td style="text-align: center; vertical-align: middle">'+$.number(data[i].selling_price,'',',')+'</td>'+
                        '<td style="text-align: center; vertical-align: middle">'+data[i].amount+'</td>'+
                        '<td style="text-align: center; vertical-align: middle">'+data[i].unit+'</td>'+
                        '<td style="text-align: center; vertical-align: middle">'+$.number(data[i].selling_price*data[i].amount,'',',')+'</td>'+
                        '<td style="text-align: center; vertical-align: middle">'+
                            '<button id="btnDelete" name="btnDelete" class="btn btn-danger text-white'+
                            ' onclick="confirmDeletionDetail('+rowData[2]+','+data[i].product_id+')">Xóa</button>'+
                        '</td>'+
                        '</tr>';
                        };
                        orderDetailContent +='</tbody>'+'</table>';
        }
            }

    });
        return orderDetailContent;
    }

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
    function confirmDeletion(order_id, product_id){
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
                window.location.href='xoa-chi-tiet/'+order_id+'/'+product_id;
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