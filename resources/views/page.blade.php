@extends('layouts.app')

@section('body')
<div id="page-container" class="fade {{ ConfigsHelper::getByKey('sidebar')== 'fixed'?'page-sidebar-fixed':'' }} {{ ConfigsHelper::getByKey('header')== 'fixed'?'page-header-fixed':'' }} in {{ ConfigsHelper::getByKey('sidebar_gradient')== 'enabled'?'gradient-enabled':'' }} {{ ConfigsHelper::getByKey('sidebar_light')== 1?'page-with-light-sidebar':'' }}">
    @include('partials.header')
    @include('partials.sidebar')
    <div id="content" class="content">
        @yield('content_header')
        @yield('content')
    </div>
</div>
@stop