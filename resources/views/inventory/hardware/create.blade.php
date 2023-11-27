@extends('page')
@section('title', 'Application Inventory')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('inventory.hardware.index') }}">Hardware Inventory</a></li>
        <li class="active">Tambah Inventory</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Tambah <small>Inventory</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Form Tambah Inventory</h4>
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => 'inventory.hardware.store', 'method' => 'post']) }}
                    @include('inventory.hardware.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
