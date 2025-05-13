@extends('page')
@section('title', 'Master')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.category.index') }}">Komoditas</a></li>
        <li class="active">Tambah Komoditas</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Tambah <small>Komoditas</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Form Komoditas</h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('komoditas.update', $komoditas) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @include('komoditas._form')
                        <button class="btn btn-success">Simpan</button>
                        <a href="{{ route('komoditas.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
