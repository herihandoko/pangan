<?php
$hardware = $data['hardware'];
?>
@extends('page')
@section('title', 'Config Monetize')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('inventory.hardware.index') }}">Hardware</a></li>
        <li class="active">Detail Hardware</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Detail <small>Hardware</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Detail Hardware</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="200">ID</th>
                                <td>{{ $hardware->id }}</td>
                            </tr>
                            <tr>
                                <th width="200">Type</th>
                                <td>{{ $hardware->type }}</td>
                            </tr>
                            <tr>
                                <th width="200">Inventory Label</th>
                                <td>{{ $hardware->inventory_tag }}</td>
                            </tr>
                            <tr>
                                <th width="200">Barcode</th>
                                <td>{{ $hardware->barcode }}</td>
                            </tr>
                            <tr>
                                <th width="200">Harga Beli</th>
                                <td>{{ $hardware->currency }}{{ $hardware->harga }}</td>
                            </tr>
                            <tr>
                                <th width="200">Manufacturer</th>
                                <td>{{ $hardware->manufacturer }}</td>
                            </tr>
                            <tr>
                                <th width="200">Brand</th>
                                <td>{{ $hardware->brand }}</td>
                            </tr>
                            <tr>
                                <th width="200">Model</th>
                                <td>{{ $hardware->model }}</td>
                            </tr>
                            <tr>
                                <th width="200">Tanggal Beli</th>
                                <td>{{ $hardware->purchase_date }}</td>
                            </tr>
                            <tr>
                                <th width="200">Berakhir Garansi</th>
                                <td>{{ $hardware->waranty_date }}</td>
                            </tr>
                            <tr>
                                <th width="200">Status</th>
                                <td>{{ $hardware->status }}</td>
                            </tr>
                            <tr>
                                <th width="200">OPD</th>
                                <td>{{ $hardware->opd->name }}</td>
                            </tr>
                            <tr>
                                <th width="200">Serial Number</th>
                                <td>{{ $hardware->serial_number }}</td>
                            </tr>
                            <tr>
                                <th width="200">Tahun Anggaran</th>
                                <td>{{ $hardware->tahun_anggaran }}</td>
                            </tr>
                            <tr>
                                <th width="200">Keterangan</th>
                                <td>{{ $hardware->description }}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{ $hardware->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Updated At</th>
                                <td>{{ $hardware->updated_at ? $hardware->updated_at : '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <div class="col-md-8">
                            <a href="{{ route('inventory.hardware.index') }}" class="btn btn-sm btn-default">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
