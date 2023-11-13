@extends('page')
@section('title', 'Modules')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('/') }}">Settings</a></li>
        <li class="active">Modules</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Modules <small>List</small></h1>
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
                        @can('create', $moduleCode)
                            <a href="#modal-dialog" class="btn btn-xs btn-icon btn-circle btn-primary btn-action-add"
                                data-toggle="modal"><i class="fa fa-plus"></i></a>
                        @endcan
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success"
                            data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning"
                            data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger"
                            data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                    <h4 class="panel-title">Modules - list</h4>
                </div>
                <div class="panel-body">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="50px">No</th>
                                <th width="30px">Icon</th>
                                <th>Name</th>
                                <th>Label</th>
                                <th>Url</th>
                                <th>Icon Name</th>
                                <th width="100px">Action</th>
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
    <!-- #modal-dialog -->
    <div class="modal fade" id="modal-dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['id' => 'MyForm', 'enctype' => 'multipart/form-data', 'name' => 'MyForm', 'class' => 'form-horizontal']) }}
                    <input type="hidden" name="id" id="id" />
                    <div class="form-group">
                        <label class="col-md-3 control-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                            <div class="invalid-feedback invalid-name"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Label</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Label" name="label" id="label" />
                            <div class="invalid-feedback invalid-label"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Code</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Label" name="code" id="code" />
                            <div class="invalid-feedback invalid-code"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Url</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Url" name="url" id="url" />
                            <div class="invalid-feedback invalid-url"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Icon</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" placeholder="Fa Icon" name="fa_icon" id="fa_icon" autocomplete="off"/>
                            <div class="invalid-feedback invalid-fa_icon"></div>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <a href="javascript:;" class="btn btn-sm btn-white btn-action-close" data-dismiss="modal"><i
                            class="fa fa-times"></i> Close</a>
                    <button class="btn btn-sm btn-success btn-action-submit"><i class="fa fa-paper-plane"></i>
                        Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" rel="stylesheet" />
    <link href="{{ asset('assets/css/fontawesome-iconpicker.min.css') }}?v=1.0" rel="stylesheet" />
@stop
@section('js')
    <script src="{{ asset('assets/js/fontawesome-iconpicker.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#fa_icon').iconpicker();

            $('#data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('settings.modules.fetch') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'icons',
                        name: 'icons'
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
                        data: 'url',
                        name: 'url'
                    },
                    {
                        data: 'fa_icon',
                        name: 'fa_icon'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $("#modal-dialog").on('show.bs.modal', function() {
                $('button.btn-action-submit').html('<i class="fa fa-paper-plane"></i> Submit');
                $('button.btn-action-submit').prop('disabled', false);
                $('.form-control').removeClass('is-invalid');
                $("form#MyForm :input").each(function() {
                    var inputName = $(this).attr('name');
                    $('.invalid-' + inputName).text('');
                    if (inputName !== undefined && inputName !== '_token') {
                        var _field = $(document).find('[name="' + inputName + '"]');
                        _field.val('');
                        _field.attr('disabled', false);
                    }
                });
                $('form#MyForm')[0].reset();
                $('button.btn-action-submit').show();
            });

            $('button.btn-action-submit').click(function(e) {
                $(this).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                $(this).prop('disabled', true);
                e.preventDefault();
                $('.form-control').removeClass('is-invalid');
                $("form#MyForm :input").each(function() {
                    var inputName = $(this).attr('name');
                    $('.invalid-' + inputName).text('');
                });
                var _form = $("form#MyForm");
                var formData = new FormData(_form[0]);
                var _id = $('input#id').val();
                var _method = 'POST';
                var _url = "{{ route('settings.modules.store') }}";
                if (_id) {
                    _url = "{{ route('settings.modules.update') }}";
                }
                $.ajax({
                    url: _url,
                    type: _method,
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    success: function(result) {
                        if (result.success) {
                            $('#modal-dialog').modal('toggle');
                            $('#data-table').DataTable().ajax.reload();
                        }
                    },
                    error: function(err) {
                        $.each(JSON.parse(err.responseText).message, function(i, error) {
                            var _field = $(document).find('[name="' + i + '"]');
                            _field.addClass('is-invalid');
                            var el = $(document).find(
                                '[class="invalid-feedback invalid-' + i + '"]');
                            el.css('display', 'block');
                            el.text(error[0]);
                        });
                        $('button.btn-action-submit').html(
                            '<i class="fa fa-paper-plane"></i> Submit');
                        $('button.btn-action-submit').prop('disabled', false);
                    }
                });
            });

            $('body').on('click', '.btn-action-delete', function() {
                var id = $(this).data("id");
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this user!",
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
                                url: "{{ route('settings.modules.destroy') }}",
                                dataType: 'JSON',
                                data: {
                                    'id': id,
                                },
                                success: function(data) {
                                    swal("Deleted!", "Your user has been deleted.",
                                        "success");
                                    $('#data-table').DataTable().ajax.reload();
                                }
                            });
                        }
                    });
            });

            $('body').on('click', '.btn-action-edit', function() {
                var id = $(this).data("id");
                $('#modal-dialog').modal('toggle');
                $.get('/settings/modules/' + id + '/edit', function(data) {
                    $('.modal-title').html("Edit User");
                    $("form#MyForm :input").each(function() {
                        var inputName = $(this).attr('id');
                        if (inputName !== undefined) {
                            var _field = $(document).find('[name="' + inputName + '"]');
                            _field.val(data[inputName]);
                            _field.attr('disabled', false);
                        }
                    });
                });
            });

            $('body').on('click', '.btn-action-view', function() {
                var id = $(this).data("id");
                $('#modal-dialog').modal('toggle');
                $('button.btn-action-submit').hide();
                $.get('/settings/modules/' + id + '/show', function(data) {
                    $('.modal-title').html("View User");
                    $("form#MyForm :input").each(function() {
                        var inputName = $(this).attr('id');
                        if (inputName !== undefined) {
                            var _field = $(document).find('[name="' + inputName + '"]');
                            _field.val(data[inputName]);
                            _field.attr('disabled', true);
                        }
                    });
                });
            });

        });
    </script>
@endsection
