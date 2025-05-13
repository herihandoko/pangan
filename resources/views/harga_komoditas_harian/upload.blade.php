@extends('page')
@section('title', 'Upload Komoditas')
@section('content_header')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ route('harga-komoditas-harian.index') }}">Harga Komoditas</a></li>
        <li class="active">Form Upload Komoditas</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Form Upload <small>Komoditas</small></h1>
    <!-- end page-header -->
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <!-- begin panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Form Upload Update Status Payout</h4>
                </div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                    @foreach ($errors->all() as $error)
                                        {{ $error }} <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success m-b-10">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger m-b-10">
                            {{ session('error') }}
                        </div>
                    @endif
                    {{ Form::open(['route' => 'data-komoditas.import', 'class' => 'form-horizontal', 'method' => 'post', 'id' => 'form-user-bank', 'enctype' => 'multipart/form-data']) }}
                    <div class="form-group">
                        <label for="waktu" class="col-md-3 control-label">Tanggal <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                        <input type="date" name="waktu" id="waktu"
                               class="form-control @error('waktu') is-invalid @enderror"
                               value="{{ old('waktu') }}">
                        @error('waktu') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                      </div>
                    <div class="form-group">
                        <label class='col-md-3 control-label'>File Excel (*.xlsx) <span class="text-danger">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" name="file" type="file"
                                accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                            <span style="color:red !important;">{{ $errors->first('file') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class='col-md-3 control-label'></label>
                        <div class="col-md-9">
                            <div class="alert alert-warning">
                                <b>Note:</b>
                                <ul>
                                    <li>Files must be less than <b>2MB</b></li>
                                    <li>Allowed file types:<b>*.xlsx</b></li>
                                    <li>Nama file tidak boleh mengandung spasi apa pun.</li>
                                    <li>You can download the data for verify here.
                                        [<a href="{{ route('harga-komoditas-harian.index') }}"><b>download</b></a>]</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9 col-md-offset-3">
                            <button id="button-import" type="submit" class="btn btn-sm btn-primary m-r-5">Import</button>
                            <a href="{{ route('harga-komoditas-harian.index') }}" class="btn btn-sm btn-default">Back</a>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $("#button-import").click(function() {
                $(this).html('<i class="fa fa-refresh fa-spin"></i> Processing');
                $("#form-user-bank").submit(); // Submit the form
            });
        });
    </script>
@endsection
