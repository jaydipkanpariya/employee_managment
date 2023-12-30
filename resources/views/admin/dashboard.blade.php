@extends('layouts.app')
@section('content')
<!-- [ breadcrumb ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-star-on"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{ $last_seven_day_sum }} </h4>
                            <h6>Total Weekly Hours</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{ $current_month_sum }} </h4>
                            <h6>Total Monthly Hours</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="feather icon-star-on"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{ $total_hours }} </h4>
                            <h6>Total Hours</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-3">
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4>{{ $total_project }}</h4>
                            <h6>Total Projects</h6>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
@endsection
