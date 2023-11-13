@extends('page')
@section('title', 'Roles')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/') }}">Settings</a></li>
    <li><a href="{{ url('/settings/roles') }}">Roles</a></li>
    <li class="active">Create Roles</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Create <small>Role</small></h1>
<!-- end page-header -->
@endsection
@section('content')
<!-- begin row -->
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Form Create Roles</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('id' => 'MyForm', 'enctype'=>"multipart/form-data",'name'=>'MyForm','method'=>'post', 'class'=>'form-horizontal')) }}
                <input type="hidden" id="id" name="id" value="{{ $role->id }}">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Role Name" value="{{ $role->name }}">
                        <div class="invalid-feedback invalid-name"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Label</label>
                    <div class="col-md-9">
                        <input type="text" name="label" class="form-control" id="label" placeholder="Role Label" value="{{ $role->label }}">
                        <div class="invalid-feedback invalid-label"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                        <input type="text" name="description" class="form-control" id="description" placeholder="Role Description" value="{{ $role->description }}">
                        <div class="invalid-feedback invalid-description"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <a href="{{ route('settings.roles.index') }}" class="btn btn-sm btn-default m-r-5"><i class="fa fa-times"></i> Close</a>
                        <button type="button" class="btn btn-sm btn-primary btn-action-submit"><i class="fa fa-save"></i> Update</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 ui-sortable">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="table-basic-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">
                    <i class="fa fa-key"></i>
                    Role Access
                </h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'settings/roles/save/'.$role->id,'method'=>'post','id'=>'MyFormTable')) }}
                <input type="hidden" name="id" value="{{ $role->id }}">
                <table class="table table-bordered dataTable no-footer table-access">
                    <thead>
                        <tr class="blockHeader">
                            <th width="40%">
                                <input class="alignTop" type="checkbox" id="module_select_all" id="module_select_all">&nbsp; Modules
                            </th>
                            <th width="15%">
                                <input type="checkbox" id="view_all">&nbsp; View
                            </th>
                            <th width="15%">
                                <input type="checkbox" id="create_all">&nbsp; Create
                            </th>
                            <th width="15%">
                                <input type="checkbox" id="edit_all">&nbsp; Edit
                            </th>
                            <th width="15%">
                                <input class="alignTop" id="delete_all" type="checkbox">&nbsp; Delete
                            </th>
                        </tr>
                    </thead>
                    @foreach($modules_access as $module)
                    <tr>
                        <td><input module_id="{{ $module->id }}" class="module_checkb" type="checkbox" name="module_{{$module->id}}" id="module_{{$module->id}}" <?php
                                                                                                                                                                    if ($module->acc_view == 1) {
                                                                                                                                                                        echo 'checked="checked"';
                                                                                                                                                                    }
                                                                                                                                                                    ?>>&nbsp; {{ $module->name }}</td>
                        <td><input module_id="{{ $module->id }}" class="view_checkb" type="checkbox" name="module_view_{{$module->id}}" id="module_view_{{$module->id}}" <?php
                                                                                                                                                                            if ($module->acc_view == 1) {
                                                                                                                                                                                echo 'checked="checked"';
                                                                                                                                                                            }
                                                                                                                                                                            ?>>
                        </td>
                        <td><input module_id="{{ $module->id }}" class="create_checkb" type="checkbox" name="module_create_{{$module->id}}" id="module_create_{{$module->id}}" <?php
                                                                                                                                                                                if ($module->acc_create == 1) {
                                                                                                                                                                                    echo 'checked="checked"';
                                                                                                                                                                                }
                                                                                                                                                                                ?>>
                        </td>
                        <td><input module_id="{{ $module->id }}" class="edit_checkb" type="checkbox" name="module_edit_{{$module->id}}" id="module_edit_{{$module->id}}" <?php
                                                                                                                                                                            if ($module->acc_edit == 1) {
                                                                                                                                                                                echo 'checked="checked"';
                                                                                                                                                                            }
                                                                                                                                                                            ?>>
                        </td>
                        <td><input module_id="{{ $module->id }}" class="delete_checkb" type="checkbox" name="module_delete_{{$module->id}}" id="module_delete_{{$module->id}}" <?php
                                                                                                                                                                                if ($module->acc_delete == 1) {
                                                                                                                                                                                    echo 'checked="checked"';
                                                                                                                                                                                }
                                                                                                                                                                                ?>>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <a href="{{ route('settings.roles.index') }}" class="btn btn-sm btn-default"><i class="fa fa-times"></i> Close</a>
                <button type="button" class="btn btn-sm btn-primary btn-action-save"><i class="fa fa-save"></i> Update</button>
                {{ Form::close() }}
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
        var _url = "{{ route('settings.roles.store') }}";
        if (_id) {
            _url = "{{ route('settings.roles.update') }}";
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
                    swal("Updated!", "Your role has been updated.", "success");
                }
                $('button.btn-action-submit').html('<i class="fa fa-save"></i> Update');
                $('button.btn-action-submit').prop('disabled', false);
            },
            error: function(err) {
                $.each(JSON.parse(err.responseText).message, function(i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
                $('button.btn-action-submit').html('<i class="fa fa-save"></i> Update');
                $('button.btn-action-submit').prop('disabled', false);
            }
        });
    });
    $('button.btn-action-save').click(function(e) {
        $(this).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        $(this).prop('disabled', true);
        e.preventDefault();
        var _form = $("form#MyFormTable");
        var formData = new FormData(_form[0]);
        var _method = 'POST';
        var _url = "{{ route('settings.roles.save') }}";
        $.ajax({
            url: _url,
            type: _method,
            data: formData,
            enctype: 'multipart/form-data',
            processData: false,
            contentType: false,
            success: function(result) {
                if (result.success) {
                    swal("Updated!", "Your role has been updated.", "success");
                }
                $('button.btn-action-save').html('<i class="fa fa-save"></i> Update');
                $('button.btn-action-save').prop('disabled', false);
            },
            error: function(err) {
                $.each(JSON.parse(err.responseText).message, function(i, error) {
                    var _field = $(document).find('[name="' + i + '"]');
                    _field.addClass('is-invalid');
                    var el = $(document).find('[class="invalid-feedback invalid-' + i + '"]');
                    el.css('display', 'block');
                    el.text(error[0]);
                });
                $('button.btn-action-save').html('<i class="fa fa-save"></i> Update');
                $('button.btn-action-save').prop('disabled', false);
            }
        });
    });

    $("#module_select_all").on("change", function() {
        $(".module_checkb").prop('checked', this.checked);
        $(".view_checkb").prop('checked', this.checked);
        $(".edit_checkb").prop('checked', this.checked)
        $(".create_checkb").prop('checked', this.checked);
        $(".delete_checkb").prop('checked', this.checked);
        $("#module_select_all").prop('checked', this.checked);
        $("#view_all").prop('checked', this.checked);
        $("#create_all").prop('checked', this.checked);
        $("#edit_all").prop('checked', this.checked);
        $("#delete_all").prop('checked', this.checked);
    });

    $(".module_checkb").on("change", function() {
        var val = $(this).attr("module_id");
        $("#module_" + val).prop('checked', this.checked)
        $("#module_view_" + val).prop('checked', this.checked);
        $("#module_create_" + val).prop('checked', this.checked)
        $("#module_edit_" + val).prop('checked', this.checked);
        $("#module_delete_" + val).prop('checked', this.checked);
    });

    $(".view_checkb").on("change", function() {
        var val = $(this).attr("module_id");
        $("#module_" + val).prop('checked', this.checked)
        $("#module_view_" + val).prop('checked', this.checked);
    });

    $(".create_checkb,  .edit_checkb, .delete_checkb").on("change", function() {
        var val = $(this).attr("module_id");
        $(this).prop('checked', this.checked);
        if (!$("#module_" + val).is(':checked')) {
            $("#module_" + val).prop('checked', this.checked);
        }
        if (!$("#module_view_" + val).is(':checked')) {
            $("#module_view_" + val).prop('checked', this.checked);
        }
    });

    $("#view_all").on("change", function() {
        $(".view_checkb").prop('checked', this.checked);
        if ($('#view_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });

    $("#create_all").on("change", function() {
        $(".create_checkb").prop('checked', this.checked);
        if ($('#create_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });

    $("#edit_all").on("change", function() {
        $(".edit_checkb").prop('checked', this.checked);
        if ($('#edit_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });

    $("#delete_all").on("change", function() {
        $(".delete_checkb").prop('checked', this.checked);
        if ($('#delete_all').is(':checked')) {
            $(".module_checkb").prop('checked', this.checked);
            $(".view_checkb").prop('checked', this.checked);
            $("#module_select_all").prop('checked', this.checked);
            $("#view_all").prop('checked', this.checked);
        }
    });
</script>
@endsection