<?php
$application = $data['application'];
$rowService = 1;
$rowSpd = 1;
$rowKmk = 1;
$rowProbis = 1;
$rowManual = 1;
?>
@extends('page')
@section('title', 'Application Inventory')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('master.category.index') }}">Application Inventory</a></li>
        <li class="active">Tambah Inventory</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Tambah <small>Inventory</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Form Tambah Inventory</h4>
                </div>
                <div class="panel-body">
                    {{ Form::open(['route' => 'inventory.application.update', 'method' => 'put']) }}
                    {{ Form::hidden('id', $application->id) }}
                    @include('inventory.application.form')
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
@section('css')
    <link href="{{ asset('assets/plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/jquery-tag-it/css/jquery.tagit.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-tag-it/js/tag-it.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('#bahasa-pemrograman').select2();
            $('a.lfm-spd').filemanager('file');
            $('a.lfm-kak').filemanager('file');
            $('a.lfm-probis').filemanager('file');
            $('a.lfm-manual').filemanager('file');
            $('.tag-it').tagit();
        });

        function add_service(){
            var room = ($('#document-service').children()).length;
            room++;
            var objTo = document.getElementById('document-service')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "row");
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = '<div class="col-md-6">'+
                    '<div class="form-group">'+
                        '<input type="text" class="form-control" name="service_name[]">'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-6">'+
                    '<input type="text" class="form-control tag-it" name="service_data[]">'+
                '</div>';
            objTo.append(divtest);
            $('.tag-it').tagit();
        }

        function add_document_spd() {
            var room = ($('#document-spd').children()).length;
            room++;
            var objTo = document.getElementById('document-spd')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group");
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + room +
                ' data-input="doc_spd' + room +
                '" data-preview="holder" class="btn btn-success lfm-spd"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_spd' +
                room + '" name="doc_spd[' + room + ']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-spd').filemanager('file');
        }

        function add_document_kmk() {
            var room = ($('#document-kmk').children()).length;
            room++;
            var objTo = document.getElementById('document-kmk')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group");
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + room +
                ' data-input="doc_kmk' + room +
                '" data-preview="holder" class="btn btn-success lfm-kak"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_kmk' +
                room + '" name="doc_kmk[' + room + ']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-kak').filemanager('file');
        }

        function add_document_probis() {
            var roomx = ($('#document-probis').children()).length;
            roomx++;
            var objTo = document.getElementById('document-probis')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group");
            var rdiv = 'removeclass' + roomx;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + roomx +
                ' data-input="doc_probis' + roomx +
                '" data-preview="holder" class="btn btn-success lfm-probis"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_probis' +
                roomx + '" name="doc_probis[' + roomx + ']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-probis').filemanager('file');
        }

        function add_document_manual() {
            var roomy = ($('#document-manual').children()).length;
            roomy++;
            var objTo = document.getElementById('document-manual')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group");
            var rdiv = 'removeclass' + roomy;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + roomy +
                ' data-input="doc_manual' + roomy +
                '" data-preview="holder" class="btn btn-success lfm-manual"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_manual' +
                roomy + '" name="doc_manual[' + roomy + ']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-manual').filemanager('file');
        }
    </script>
@stop
