@extends('page')
@section('title', 'Config Monetize')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.category.index') }}">Kategori</a></li>
        <li class="active">Detail Kategori</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail <small>Kategori</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Detail Kategori</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $category->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $category->name }}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{ $category->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Updated At</td>
                                <td>{{ $category->updated_at ? $category->updated_at : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-8">
                            <a href="{{ route('master.category.index') }}" class="btn btn-sm btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
