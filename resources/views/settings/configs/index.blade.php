@extends('page')
@section('title', 'Configs')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/') }}">Settings</a></li>
    <li class="active">Configs</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Configs <small>Form</small></h1>
<!-- end page-header -->
@endsection
@section('content')
<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12 ui-sortable">
        <!-- begin panel -->
        <div class="panel panel-inverse" data-sortable-id="form-stuff-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Form Configs</h4>
            </div>
            <div class="panel-body">
                {{ Form::open(array('id' => 'MyForm', 'enctype'=>"multipart/form-data",'name'=>'MyForm','method'=>'post', 'class'=>'form-horizontal')) }}
                <!-- text input -->
                <div class="form-group">
                    <label class="col-md-3 control-label">Sitename <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="RCTI+" name="sitename" value="{{$configs->sitename}}">
                        <div class="invalid-feedback invalid-sitename"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Sitename First Word <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="RCTI+" name="sitename_part1" value="{{$configs->sitename_part1}}">
                        <div class="invalid-feedback invalid-sitename_part1"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Sitename Second Word <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="RCTI+ 1.0" name="sitename_part2" value="{{$configs->sitename_part2}}">
                        <div class="invalid-feedback invalid-sitename_part2"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Sitename Short (2/3 Characters) <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="R+" maxlength="2" name="sitename_short" value="{{$configs->sitename_short}}">
                        <div class="invalid-feedback invalid-sitename_short"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Site Description <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="Description in 140 Characters" maxlength="140" name="site_description" value="{{$configs->site_description}}">
                        <div class="invalid-feedback invalid-site_description"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Header Styling <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="header_styling">
                            <option value="default" @if($configs->header_styling == 'default') selected @endif>Default</option>
                            <option value="inverse" @if($configs->header_styling == 'inverse') selected @endif>Inverse</option>
                        </select>
                        <div class="invalid-feedback invalid-header_styling"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Header <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="header">
                            <option value="default" @if($configs->header == 'default') selected @endif>Default</option>
                            <option value="fixed" @if($configs->header == 'fixed') selected @endif>Fixed</option>
                        </select>
                        <div class="invalid-feedback invalid-header"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Sidebar Styling <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="sidebar_styling">
                            <option value="default" @if($configs->sidebar_styling == 'default') selected @endif>Default</option>
                            <option value="grid" @if($configs->sidebar_styling == 'grid') selected @endif>Grid</option>
                        </select>
                        <div class="invalid-feedback invalid-sidebar_styling"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Sidebar <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="sidebar">
                            <option value="default" @if($configs->sidebar == 'default') selected @endif>Default</option>
                            <option value="fixed" @if($configs->sidebar == 'fixed') selected @endif>Fixed</option>
                        </select>
                        <div class="invalid-feedback invalid-sidebar"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Sidebar Gradient <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="sidebar_gradient">
                            <option value="disabled" @if($configs->sidebar_gradient == 'disabled') selected @endif>Disabled</option>
                            <option value="enabled" @if($configs->sidebar_gradient == 'enabled') selected @endif>Enabled</option>
                        </select>
                        <div class="invalid-feedback invalid-sidebar_gradient"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Content Styling <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <select class="form-control" name="content_styling">
                            <option value="default" @if($configs->content_styling == 'default') selected @endif>Default</option>
                            <option value="black" @if($configs->content_styling == 'black') selected @endif>Black</option>
                        </select>
                        <div class="invalid-feedback invalid-content_styling"></div>
                    </div>
                </div>
                <!-- checkbox -->
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sidebar_search" @if($configs->sidebar_search) checked @endif>
                                Show Search Bar
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="show_notifications" @if($configs->show_notifications) checked @endif>
                                Show Notifications Icon
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sidebar_transparent" @if($configs->sidebar_transparent) checked @endif>
                                Sidebar Transparent
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="sidebar_light" @if($configs->sidebar_light) checked @endif>
                                Light Sidebar
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Email <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" placeholder="To send emails to others via SMTP" maxlength="100" name="default_email" value="{{$configs->default_email}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="button" class="btn btn-sm btn-primary m-r-5 btn-action-submit"><i class="fa fa-save"></i> Save</button>
                        <a href="{{ url('/') }}" class="btn btn-sm btn-default"><i class="fa fa-times"></i> Cancel</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-6 -->
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

        $('button.btn-action-submit').click(function(e) {
            $(this).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
            $(this).prop('disabled', true);
            e.preventDefault();
            var _form = $("form#MyForm");
            var formData = new FormData(_form[0]);
            var _method = 'POST';
            var _url = "{{ route('settings.configs.store') }}";
            $.ajax({
                url: _url,
                type: _method,
                data: formData,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                success: function(result) {
                    if (result.success) {
                        swal({
                            title: "Updated!",
                            text: "Your cms has been updated.",
                            icon: "success",
                            button: "Aww yiss!",
                        }, function() {
                            window.location.reload();
                        });
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
    });
</script>
@endsection