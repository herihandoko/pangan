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
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label class="col-md-3 control-label">Name</label>
                    <div class="col-md-9">
                        <input type="text" name="name" class="form-control" id="name" placeholder="Role Name">
                        <div class="invalid-feedback invalid-name"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Label</label>
                    <div class="col-md-9">
                        <input type="text" name="label" class="form-control" id="label" placeholder="Role Label">
                        <div class="invalid-feedback invalid-label"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Description</label>
                    <div class="col-md-9">
                        <input type="text" name="description" class="form-control" id="description" placeholder="Role Description">
                        <div class="invalid-feedback invalid-description"></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <a href="{{ route('settings.roles.index') }}" class="btn btn-sm btn-default m-r-5"><i class="fa fa-times"></i> Close</a>
                        <button type="button" class="btn btn-sm btn-primary btn-action-submit"><i class="fa fa-save"></i> Save</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
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
        var _method = 'POST';
        var _url = "{{ route('settings.roles.store') }}";
        var _id = $('input#id').val();
        if (_id) {
            _url = "{{ route('settings.roles.update') }}";
            _method = 'POST';
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
                    $('input#id').val(result.id);
                    if (_id) {
                        swal("Updated!", "Your role has been updated.", "success");
                    } else {
                        swal("Created!", "Your role has been created.", "success");
                        window.location.href = "{!! url('settings/roles/" + result.id + "/edit') !!}";
                    }
                }
                $('button.btn-action-submit').html('<i class="fa fa-save"></i> Save');
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
                $('button.btn-action-submit').html('<i class="fa fa-save"></i> Save');
                $('button.btn-action-submit').prop('disabled', false);
            }
        });
    });
</script>
@endsection