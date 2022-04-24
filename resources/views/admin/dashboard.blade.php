@extends('templates.admin_master' , ['tittlePage' => 'Tổng Quan'])
@section('css')
<link href="{{asset('public/backend/assets/libs/flot/css/float-chart.css')}}" rel="stylesheet">
@endsection
@section('content_admin')
<div>
    <p style="padding-left: 20px; font-size: 1em; font-weight: bold;">Xin Chào
         <?php
        $admin = Session::get('admin');
        if($admin){
            echo $admin->name;
        }
    ?></h1>
</div>
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Sales Cards  -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-view-dashboard"></i></h1>
                    <h6 class="text-white">Dashboard</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-chart-areaspline"></i></h1>
                    <h6 class="text-white">Charts</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-collage"></i></h1>
                    <h6 class="text-white">Widgets</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-border-outside"></i></h1>
                    <h6 class="text-white">Tables</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-arrow-all"></i></h1>
                    <h6 class="text-white">Full Width</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <!-- Column -->
        <div class="col-md-6 col-lg-4 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-danger text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-receipt"></i></h1>
                    <h6 class="text-white">Forms</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-info text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-relative-scale"></i></h1>
                    <h6 class="text-white">Buttons</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-cyan text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-pencil"></i></h1>
                    <h6 class="text-white">Elements</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-success text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-calendar-check"></i></h1>
                    <h6 class="text-white">Calnedar</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-md-6 col-lg-2 col-xlg-3">
            <div class="card card-hover">
                <div class="box bg-warning text-center">
                    <h1 class="font-light text-white"><i class="mdi mdi-alert"></i></h1>
                    <h6 class="text-white">Errors</h6>
                </div>
            </div>
        </div>
        <!-- Column -->
    </div>
@endsection
@section('js')
    <!-- Charts js Files -->
    <script src="{{asset('public/backend/assets/libs/flot/excanvas.js')}}"></script>
    <script src="{{asset('public/backend/assets/libs/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('public/backend/assets/libs/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('public/backend/assets/libs/flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('public/backend/assets/libs/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('public/backend/assets/libs/flot/jquery.flot.crosshair.js')}}"></script>
    <script src="{{asset('public/backend/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('public/backend/dist/js/pages/chart/chart-page-init.js')}}"></script>
@endsection