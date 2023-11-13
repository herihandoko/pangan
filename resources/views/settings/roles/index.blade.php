@extends('page')
@section('title', 'Roles')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/') }}">Settings</a></li>
    <li class="active">Roles</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Roles <small>List</small></h1>
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
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    @can('create', $moduleCode)
                    <a href="{{ route('settings.roles.create') }}" class="btn btn-xs btn-icon btn-circle btn-primary"><i class="fa fa-plus"></i></a>
                    @endcan
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Roles - list</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Name</th>
                            <th>Label</th><!-- comment -->
                            <th>Description</th>
                            <th width="200px">Action</th>
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
@section('css')
@stop
@section('js')
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
            ajax: "{{ route('settings.roles.fetch') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'label',
                    name: 'label'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        $('body').on('click', '.btn-action-delete', function() {
            var id = $(this).data("id");
            swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this roles!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false
                },
                function(result) {
                    if (result) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('settings.roles.destroy') }}",
                            dataType: 'JSON',
                            data: {
                                'id': id,
                            },
                            success: function(data) {
                                swal("Deleted!", "Your user has been deleted.", "success");
                                $('#data-table').DataTable().ajax.reload();
                            }
                        });
                    }
                });
        });
    });
</script>
@endsection