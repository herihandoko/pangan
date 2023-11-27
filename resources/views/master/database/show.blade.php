@extends('page')
@section('title', 'Config Monetize')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.database.index') }}">Basis Data</a></li>
        <li class="active">Detail Basis Data</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail <small>Basis Data</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Detail Basis Data</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $database->id }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $database->name }}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{ $database->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Updated At</td>
                                <td>{{ $database->updated_at ? $database->updated_at : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-8">
                            <a href="{{ route('master.database.index') }}" class="btn btn-sm btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
