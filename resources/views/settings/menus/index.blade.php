@extends('page')
@section('title', 'Menus')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li><a href="{{ url('/') }}">Settings</a></li>
    <li class="active">Menus</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Menus <small>List</small></h1>
<!-- end page-header -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-4 ui-sortable">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Modules</h4>
            </div>
            <div class="panel-body" id="tab-modules">
                <ul style="padding-left: 0px !important;">
                    @foreach ($modules as $module)
                    <li><i class="fa {{ $module->fa_icon }}"></i> {{ $module->name }} <a module_id="{{ $module->id }}" class="addModuleMenu pull-right"><i class="fa fa-plus"></i></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8 ui-sortable">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title">Menus</h4>
            </div>
            <div class="panel-body" id="tab-modules">
                <div class="dd" id="menu-nestable">
                    <ol class="dd-list">
                        @foreach ($menus as $menu)
                        <?php echo MenuHelper::print_menu_editor($menu); ?>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.css">
<style>
    #tab-custom-link {
        min-height: 150px;
    }

    #menu-custom-form input {
        width: 75%;
        display: inline-block;
        padding: 0px 8px;
        height: 30px;
    }

    #menu-custom-form label {
        width: 20%;
        display: inline-block;
    }

    #menu-custom-form .input-group.iconpicker-container {
        width: 75%;
        display: inline-block;
        vertical-align: bottom;
    }

    #menu-custom-form .input-group.iconpicker-container .input-group-addon {
        height: 30px;
        padding: 0px;
        width: 60px;
        font-size: 20px;
    }

    .input-group .input-group-addon {
        border-radius: 0;
        border-color: #d2d6de;
        background-color: #fff;
    }

    .input-group-addon:last-child {
        border-left: 0;
    }

    .mr10 {
        margin-right: 10px;
    }

    .dd3-handle {
        position: absolute;
        margin: 0;
        left: 0;
        top: 0;
        cursor: pointer;
        width: 30px;
        text-indent: 100%;
        white-space: nowrap;
        overflow: hidden;
        border: 1px solid #aaa;
        background: #ddd;
        background: linear-gradient(top, #ddd 0%, #bbb 100%);
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        height: 40px;
    }

    .dd3-handle:before {
        content: '≡';
        display: block;
        position: absolute;
        left: 0;
        /*top: 3px;*/
        width: 100%;
        text-align: center;
        text-indent: 0;
        color: #fff;
        font-size: 20px;
        font-weight: normal;
    }

    .dd3-content {
        display: block;
        max-width: 250px;
        height: 30px;
        margin: 5px 0;
        padding: 10px 5px 5px 40px;
        color: #333;
        text-decoration: none;
        font-weight: bold;
        border: 1px solid #ccc;
        background: #fafafa;
        background: linear-gradient(top, #fafafa 0%, #eee 100%);
        border-radius: 3px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 40px;
    }

    .dd3-content .btn {
        display: none;
        padding: 0px 4px;
        padding-right: 0px;
        margin-left: 3px;
        margin-top: -1px;
    }

    .dd3-content i.fa {
        width: 15px;
        text-align: center;
        margin-right: 3px;
    }

    .dd3-content:hover {
        color: #2ea8e5;
        background: #fff;
    }

    .dd3-content:hover .btn {
        display: inline-block;
    }

    #tab-modules ul li {
        list-style: none;
        padding: 3px 7px;
        border: solid 1px #cccccc;
        border-radius: 3px;
        background: #f5f5f5;
        margin-bottom: 4px;
    }

    .box.menus .tab-content {
        padding: 20px;
    }

    .addModuleMenu {
        float: right;
    }

    .btn-menu-remove {
        float: right;
    }
</style>
@stop
@section('js')
<script src="{{ asset('assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script>
    $(function() {
        $('#menu-nestable').nestable({
            group: 1
        });
        $('#menu-nestable').on('change', function() {
            var jsonData = $('#menu-nestable').nestable('serialize');
            $.ajax({
                url: "{{ route('settings.menus.update') }}",
                method: 'PUT',
                data: {
                    jsonData: jsonData,
                    "_token": '{{ csrf_token() }}'
                }
            });
        });
        $("#tab-modules .addModuleMenu").on("click", function() {
            var module_id = $(this).attr("module_id");
            $.ajax({
                url: "{{ route('settings.menus.store') }}",
                method: 'POST',
                data: {
                    type: 'module',
                    module_id: module_id,
                    "_token": '{{ csrf_token() }}'
                },
                success: function(data) {
                    // console.log(data);
                    window.location.reload();
                }
            });
        });
    });
</script>
@stop