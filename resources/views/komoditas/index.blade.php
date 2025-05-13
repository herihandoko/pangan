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
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default"
                            data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="{{ route('komoditas.create') }}"
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
                                        <th>Nama Pangan</th>
                                        <th>HPP/HET</th>
                                        <th>Source</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($komoditas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($komoditas->currentPage() - 1) * $komoditas->perPage() }}
                                            </td>
                                            <td>{{ $item->nama_pangan }}</td>
                                            <td>{{ $item->{'hpp/het'} }}</td>
                                            <td>{{ $item->source }}</td>
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
                                    @if ($komoditas->total() > 0)
                                        Showing {{ $komoditas->firstItem() }}
                                        to {{ $komoditas->lastItem() }}
                                        of {{ $komoditas->total() }}
                                        entries
                                    @else
                                        No entries found.
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <div class="dataTables_paginate paging_simple_numbers" id="data-table_paginate">
                                    {!! $komoditas->onEachSide(1)->links('pagination::bootstrap-4') !!}
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
