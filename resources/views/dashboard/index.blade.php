@extends('dashboard.layouts.master')

@section('main-content')

@section('page-title')
    Dashboard
@endsection

@section('page-name')
    Dashboard
@endsection

<div class="row row-cols-1 row-cols-xxl-6 row-cols-lg-3 row-cols-md-2">
    <div class="col">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Customers">
                            Total Users</h5>
                        <h3 class="my-3">{{$usersCount}}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-success rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-group-line"></i>
                        </span>
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Number of Orders">Total Agents
                        </h5>
                        <h3 class="my-3">{{$agentsCount}}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-info rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-shopping-basket-2-line"></i>
                        </span>
                    </div>
                </div>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Average Revenue">Total Team Leaders
                        </h5>
                        <h3 class="my-3">{{$teamLeadCount}}</h3>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-danger rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-money-dollar-circle-line"></i>
                        </span>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <div class="col">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Growth">Pending Tasks</h5>
                        <h3 class="my-3">{{$Pendingtasks}}</h3>
                      
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-primary rounded rounded-3 fs-3 widget-icon-box-avatar shadow">
                            <i class="ri-donut-chart-line"></i>
                        </span>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    <div class="col">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">
                            Completed Tasks</h5>
                        <h3 class="my-3">{{$completedtasks}}</h3>
                        {{-- <p class="mb-0 text-muted text-truncate">
                            <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                3.07%</span>
                            <span>Since last month</span>
                        </p> --}}
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-warning rounded rounded-3 fs-3 widget-icon-box-avatar">
                            <i class="ri-pulse-line"></i>
                        </span>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->
    <div class="col">
        <div class="card widget-icon-box">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1 overflow-hidden">
                        <h5 class="text-muted text-uppercase fs-13 mt-0" title="Conversation Ration">Total Accountant
                        </h5>
                        <h3 class="my-3">{{$AccountingCount}}</h3>
                        <p class="mb-0 text-muted text-truncate">
                            {{-- <span class="badge bg-success me-1"><i class="ri-arrow-up-line"></i>
                                18.34%</span>
                            <span>Since last month</span> --}}
                        </p>
                    </div>
                    <div class="avatar-sm flex-shrink-0">
                        <span class="avatar-title text-bg-dark rounded rounded-3 fs-3 widget-icon-box-avatar">
                            <i class="ri-wallet-3-line"></i>
                        </span>
                    </div>
                </div>

            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col-->

    <!-- content -->
@endsection
