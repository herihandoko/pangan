<?php
$servers = $data['servers'];
?>
@extends('page')
@section('title', 'Config Monetize')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.servers.index') }}">Server</a></li>
        <li class="active">Detail Server</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail <small>Server</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Detail Server</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{ $servers->id }}</td>
                            </tr>
                            <tr>
                                <td>Hardware</td>
                                <td>{{ $servers->hardware->inventory_tag ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>{{ $servers->type ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Hardisc</td>
                                <td>{{ $servers->hdd ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td>{{ $servers->ram ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>CPU</td>
                                <td>{{ $servers->cpu ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ $servers->status ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td>Created At</td>
                                <td>{{ $servers->created_at }}</td>
                            </tr>
                            <tr>
                                <td>Updated At</td>
                                <td>{{ $servers->updated_at ? $servers->updated_at : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-8">
                            <a href="{{ route('master.servers.index') }}" class="btn btn-sm btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
