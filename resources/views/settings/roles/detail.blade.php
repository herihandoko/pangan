@extends('page')
@section('title', 'Roles')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/') }}">Settings</a></li>
    <li><a href="{{ url('/settings/roles') }}">Roles</a></li>
    <li class="active">View Roles</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">View <small>Role</small></h1>
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
                        <input type="text" name="name" class="form-control" id="name" placeholder="Role Name" value="{{ $role->name }}" disabled>
                        <div class="invalid-feedback invalid-name"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Label</label>
                    <div class="col-md-9">
                        <input type="text" name="label" class="form-control" id="label" placeholder="Role Label" value="{{ $role->label }}" disabled>
                        <div class="invalid-feedback invalid-label"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                        <input type="text" name="description" class="form-control" id="description" placeholder="Role Description" value="{{ $role->description }}" disabled>
                        <div class="invalid-feedback invalid-description"></div>
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
                {{ Form::close() }}
            </div>
        </div>
        <!-- end panel -->
    </div>
</div>
@endsection