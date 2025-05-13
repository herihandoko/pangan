@extends('page')
@section('title', 'Komoditas')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}">Master</a></li>
        <li class="active">Komoditas</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Komoditas <small>List</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-default" data-sortable-id="table-basic-7">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Filter</h4>
                </div>
                <div class="panel-body">
                    {{ Form::open(['class' => 'form-horizontal', 'method'=>"get"]) }}    
                        <div class="form-group">
                            <label class="control-label col-md-2">Kabupaten/Kota : </label>
                            <div class="col-md-4">
                                {{ Form::select('kode_kab',$kabupaten,old('kode_kab',$request->kode_kab),['class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Komoditas : </label>
                            <div class="col-md-4">
                                {{ Form::select('id_komoditas',$komoditas,old('id_komoditas',$request->id_komoditas),['class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Tanggal : </label>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::date('start_date',old('start_date',$request->start_date),['class'=>'form-control']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::date('end_date',old('end_date',$request->end_date),['class'=>'form-control']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-2"></div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary m-r-5 btn-show-data"><i class="fa fa-filter m-r-5"></i>Show Data</button>
                            </div>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="{{ route('data-komoditas.upload') }}" class="btn btn-xs btn-icon btn-circle btn-default">
                            <i class="fa fa-upload"></i></a>
                        <a href="{{ route('harga-komoditas-harian.create') }}"
                            class="btn btn-xs btn-icon btn-circle btn-primary btn-action-add"><i class="fa fa-plus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Kategori - list</h4>
                </div>
                <div class="panel-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                        <div class="row">
                            <table id="data-table" class="table table-striped table-bordered responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Komoditas</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                        <th>Tanggal Input</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                                            </td>
                                            <td>{{ $item->komoditas->nama_pangan }}</td>
                                            <td>{{ $item->komoditas->satuan }}</td>
                                            <td align="right">{{ number_format($item->harga,2) }}</td>
                                            <td>{{ date('d M Y',strtotime($item->waktu)) }}</td>
                                            <td>
                                                <a href="{{ route('komoditas.show', $item) }}"
                                                    class="btn btn-xs btn-icon btn-circle btn-success btn-action-view"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="{{ route('komoditas.edit', $item) }}" data-toggle="tooltip"
                                                    data-id="1" data-original-title="Edit"
                                                    class="btn btn-xs btn-icon btn-circle btn-warning btn-action-edit"><i
                                                        class="fa fa-pencil"></i></a>
                                                <form action="{{ route('komoditas.destroy', $item) }}" method="POST"
                                                    class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                                    @csrf @method('DELETE')
                                                    <button
                                                        class="btn btn-xs btn-icon btn-circle btn-danger btn-action-delete"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite">
                                    @if ($data->total() > 0)
                                        Showing {{ $data->firstItem() }}
                                        to {{ $data->lastItem() }}
                                        of {{ $data->total() }}
                                        entries
                                    @else
                                        No entries found.
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                                    {!! $data->onEachSide(1)->links('pagination::bootstrap-4') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
@endsection
