@extends('page')
@section('title', 'Dashboard')
@section('content_header')
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="{{ url('/') }}">Home</a></li>
    <li class="active">Gallery</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Gallery <small>Quizz</small></h1>
<!-- end page-header -->
@endsection
@section('content')
<!-- begin row -->
<div class="row">
    <div class="col-md-12">
        <iframe src="{{ url('/laravel-filemanager') }}" style="width: 100%; height: 700px; overflow: hidden; border: none;"></iframe>
    </div>
</div>
<!-- end row -->
<!-- End Modal Form Create Quiz -->
@endsection