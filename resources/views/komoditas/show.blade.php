@extends('page')
@section('title', 'Komoditas')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('komoditas.index') }}">Komoditas</a></li>
        <li class="active">Show Komoditas</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Show <small>Komoditas</small></h1>
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
                    <h2>Detail Komoditas</h2>
                    <a href="{{ route('komoditas.index') }}" class="btn btn-secondary mb-3">← Kembali ke Daftar</a>

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th scope="row" style="width: 25%;">ID</th>
                                <td>{{ $komoditas->id_kmd }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Nama Pangan</th>
                                <td>{{ $komoditas->nama_pangan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">HPP / HET</th>
                                <td>{{ $komoditas->{'hpp/het'} }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Source</th>
                                <td>{{ $komoditas->source }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dibuat Pada</th>
                                <td>{{ optional($komoditas->created_at)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Diupdate Pada</th>
                                <td>{{ optional($komoditas->update_at)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
