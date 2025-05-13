@extends('page')
@section('title', 'Administrasi')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('administrasi.index') }}">Administrasi</a></li>
        <li class="active">Show Administrasi</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Show <small>Administrasi</small></h1>
    <!-- end page-header -->
@endsection
@section('content')

    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Form Administrasi</h4>
                </div>
                <div class="panel-body">
                    <h2>Detail Administrasi</h2>
                    <a href="{{ route('administrasi.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar</a>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 25%;">Kode Administrasi</th>
                                <td>{{ $administrasi->kd_adm }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Wilayah Administrasi</th>
                                <td>{{ $administrasi->wilayah_adm }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Administrasi</th>
                                <td>{{ $administrasi->nm_adm }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Source</th>
                                <td>{{ $administrasi->source }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dibuat Pada</th>
                                <td>{{ optional($administrasi->created_at)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Diupdate Pada</th>
                                <td>{{ optional($administrasi->update_at)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
