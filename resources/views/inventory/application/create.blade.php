@extends('page')
@section('title', 'Application Inventory')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('inventory.application.index') }}">Application Inventory</a></li>
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
                    {{ Form::open(['route' => 'inventory.application.store', 'method' => 'post']) }}
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
@endsection
@section('js')
    <script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
    <script src="{{ asset('/vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/dist/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
            $('a.lfm-kak').filemanager('file');
            $('a.lfm-probis').filemanager('file');
            $('a.lfm-manual').filemanager('file');
        });
        room = 1;

        function add_document_kmk() {
            room++;
            var objTo = document.getElementById('document-kmk')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + room);
            var rdiv = 'removeclass' + room;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + room + ' data-input="doc_kmk' + room + '" data-preview="holder" class="btn btn-success lfm-kak"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_kmk'+room+'" name="doc_kmk['+room+']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-kak').filemanager('file');
        }

        roomx = 1;
        function add_document_probis() {
            roomx++;
            var objTo = document.getElementById('document-probis')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + roomx);
            var rdiv = 'removeclass' + roomx;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + roomx + ' data-input="doc_probis' + roomx + '" data-preview="holder" class="btn btn-success lfm-probis"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_probis'+roomx+'" name="doc_probis['+roomx+']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-probis').filemanager('file');
        }

        roomy = 1;
        function add_document_manual() {
            roomy++;
            var objTo = document.getElementById('document-manual')
            var divtest = document.createElement("div");
            divtest.setAttribute("class", "form-group removeclass" + roomy);
            var rdiv = 'removeclass' + roomy;
            divtest.innerHTML = '<div class="input-group"><span class="input-group-btn"><a value=' + roomy + ' data-input="doc_manual' + roomy + '" data-preview="holder" class="btn btn-success lfm-manual"><i class="fa fa-file"></i> Pilih...</a></span><input class="form-control" id="doc_manual'+roomy+'" name="doc_manual['+roomy+']" type="text"></div>';
            objTo.append(divtest)
            $('a.lfm-manual').filemanager('file');
        }
    </script>
@stop
