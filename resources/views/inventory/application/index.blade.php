@extends('page')
@section('title', 'Application')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}">Inventory</a></li>
        <li class="active">Aplikasi</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Aplikasi <small>List</small></h1>
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
                        @can('create', $data['moduleCode'])
                            <a href="{{ route('inventory.application.create') }}"
                                class="btn btn-xs btn-icon btn-circle btn-primary btn-action-add"><i class="fa fa-plus"></i></a>
                        @endcan
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Aplikasi - list</h4>
                </div>
                <div class="panel-body">
                    @include('master.message')
                    <table id="data-table" class="table table-striped table-bordered responsive" width="100%">
                        <thead>
                            <tr>
                                <th width="32">Status</th>
                                <th>ID</th>
                                <th>Nama Aplikasi</th>
                                <th>Versi</th>
                                <th>Pembuat</th>
                                <th>OPD</th>
                                <th>Scope</th>
                                <th>Kategori</th>
                                <th>Platform</th>
                                <th>Tahun Anggaran</th>
                                <th>Type Hosting</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col-12 -->
    </div>
    <!-- end row -->
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{!! route('inventory.application.fetch') !!}",
                    data: function(data) {
                        const _filter = {};
                        data.status = '{{ $data['status'] }}';
                    },
                    type: "GET"
                },
                columns: [{
                        data: 'status',
                        width: 25,
                        name: 'status'
                    },
                    {
                        data: 'id',
                        width: 25,
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'version',
                        name: 'version'
                    },
                    {
                        data: 'manufacturer',
                        name: 'manufacturer'
                    },
                    {
                        data: 'opd',
                        name: 'opd'
                    },
                    {
                        data: 'scope',
                        name: 'scope'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'platform',
                        name: 'platform'
                    },
                    {
                        data: 'tahun_anggaran',
                        name: 'tahun_anggaran'
                    },
                    {
                        data: 'type_hosting',
                        name: 'type_hosting'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        width: 100,
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $('body').on('click', '.btn-action-delete', function() {
                var id = $(this).data("id");
                swal({
                        title: "Apa Anda Yakin?",
                        text: "Data yang sudah di hapus, tidak bisa di kembalikan lagi!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Ya, hapus data ini!",
                        closeOnConfirm: false
                    },
                    function(result) {
                        if (result) {
                            $.ajax({
                                type: "DELETE",
                                url: "{{ route('inventory.application.destroy') }}",
                                dataType: 'JSON',
                                data: {
                                    'id': id,
                                },
                                success: function(data) {
                                    swal("Berhasil!", "Data berhasil dihapus.",
                                        "success");
                                    $('#data-table').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection
