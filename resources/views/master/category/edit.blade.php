@extends('page')
@section('title', 'Master')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.category.index') }}">Kategori</a></li>
        <li class="active">Edit kategori</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Edit <small>Kategori</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Form Kategori</h4>
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => 'master.category.update', 'class' => 'form-horizontal', 'method' => 'put']) }}
                    {{ Form::hidden('id', $category->id) }}
                    @include('master.category.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
