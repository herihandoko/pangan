@extends('page')
@section('title', 'Dashboard')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Dashboard <small>Application Management Software</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-green">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>TOTAL APPLICATIONS</h4>
                    <p>{{ number_format($app_all, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.application.index') }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>ARCHIVED APPLICATIONS</h4>
                    <p>{{ number_format($app_inactive, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.application.index', ['status' => 'inactive']) }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-purple">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>ACTIVE APPLICATIONS</h4>
                    <p>{{ number_format($app_active, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.application.index', ['status' => 'active']) }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
        <!-- begin col-3 -->
        <div class="col-md-3 col-sm-6">
            <div class="widget widget-stats bg-red">
                <div class="stats-icon"><i class="fa fa-tasks"></i></div>
                <div class="stats-info">
                    <h4>TOTAL HARDWARE</h4>
                    <p>{{ number_format($hardware, 0) }}</p>
                </div>
                <div class="stats-link">
                    <a href="{{ route('inventory.hardware.index') }}">View Detail <i
                            class="fa fa-arrow-circle-o-right"></i></a>
                </div>
            </div>
        </div>
        <!-- end col-3 -->
    </div>
    <!-- end row -->
    <div class="row">
        <!-- begin col-8 -->
        <div class="col-md-8">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Annual Cost Application Name</h4>
                </div>
                <div class="panel-body">
                    <p>
                        Diagram total biaya perangkat lunak berdasarkan nama aplikasi.
                    </p>
                    <canvas id="bar-chart" data-render="chart-js"></canvas>
                </div>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">OPD Application Graphic</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nama OPD</th>
                                <th>Total Aplikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Hosting Type Application</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-valign-middle m-b-0">
                        <thead>
                            <tr>
                                <th>Hosting Type</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label class="label label-danger">On-prem</label></td>
                                <td>{{ $hosting_type['on_prem'] }} <span class="text-success"><i
                                            class="fa fa-arrow-up"></i></span></td>
                            </tr>
                            <tr>
                                <td><label class="label label-warning">Cloud</label></td>
                                <td>{{ $hosting_type['cloud'] }} <span class="text-danger"><i
                                            class="fa fa-arrow-down"></i></span></td>
                            </tr>
                            <tr>
                                <td><label class="label label-success">Hybrid</label></td>
                                <td>{{ $hosting_type['hybrid'] }} <span class="text-success"><i
                                            class="fa fa-arrow-up"></i></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Application Status</h4>
                </div>
                <div class="panel-body">
                    <canvas id="application-status"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('bar-chart').getContext("2d");
        var appStatus = document.getElementById('application-status').getContext("2d");
        getAnnualCost(ctx);
        getAplikasiStatus(appStatus);

        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            lengthChange: false,
            pageLength: 5,
            ajax: {
                url: "{{ route('home.opdapp') }}",
                type: "GET"
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'inventory_count',
                    name: 'inventory_count'
                }
            ],
        });

        function getAnnualCost(ctx) {
            $.ajax({
                type: "get",
                url: "{{ route('home.costapp') }}",
                dataType: 'JSON',
                success: function(data) {
                    if (data.success) {
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: data.data,
                            options: {
                                indexAxis: 'y',
                                elements: {
                                    bar: {
                                        borderWidth: 2,
                                    }
                                },
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: false,
                                        text: 'Chart.js Horizontal Bar Chart'
                                    }
                                }
                            },
                        });
                    }
                }
            });
        }

        function getAplikasiStatus(appStatus) {
            $.ajax({
                type: "get",
                url: "{{ route('home.stsapp') }}",
                dataType: 'JSON',
                success: function(data) {
                    if (data.success) {
                        var myChart = new Chart(appStatus, {
                            type: 'doughnut',
                            data: data.data,
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: false,
                                        text: 'Chart.js Doughnut Chart'
                                    }
                                }
                            },
                        });
                    }
                }
            });
        }
    </script>
@endsection
