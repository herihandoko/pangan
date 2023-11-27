<?php
$application = $data['application'];
?>
@extends('page')
@section('title', 'Config Monetize')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('inventory.application.index') }}">Applikasi</a></li>
        <li class="active">Detail Applikasi</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail <small>Applikasi</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Detail Applikasi</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td>{{ $application->id }}</td>
                            </tr>
                            <tr>
                                <th>Kode Aplikasi</th>
                                <td>{{ $application->code }}</td>
                            </tr>
                            <tr>
                                <th>Nama Applikasi</th>
                                <td>{{ $application->name }}</td>
                            </tr>
                            <tr>
                                <th>Versi</th>
                                <td>{{ $application->version }}</td>
                            </tr>
                            <tr>
                                <th>Basis Pengguna</th>
                                <td>{{ $application->user_base }}</td>
                            </tr>
                            <tr>
                                <th>Scope</th>
                                <td>{{ $application->scope }}</td>
                            </tr>
                            <tr>
                                <th>URL/Domain</th>
                                <td>{{ $application->url }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $application->status }}</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>{{ $application->keterangan }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $application->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $application->updated_at ? $application->updated_at : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h4>Detail Pemilik</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">OPD</th>
                                <td>{{ $application->opd->name }}</td>
                            </tr>
                            <tr>
                                <th>Sub Unit</th>
                                <td>{{ $application->program->name }}</td>
                            </tr>
                            <tr>
                                <th>Tahun Anggaran</th>
                                <td>{{ $application->tahun_anggaran }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-8">
                            <a href="{{ route('inventory.application.index') }}" class="btn btn-sm btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
