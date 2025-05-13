@extends('layouts.app')
@section('title', 'Login')
@section('classes_body'){{ 'pace-top bg-white' }}@stop
@section('css')
<style>
    .img-icon-login {
        height: 48px;
        position: relative;
        font-size: 0;
        margin-right: 5px;
        top: -5px;
    }
</style>
@stop
@section('body')
<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image">
                <img src="{{ asset('assets/img/login-bg/bg-1.jpg') }}" data-id="login-cover-image" alt="Background Login" />
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <!-- <span class="logo"></span> R+ Studio -->
                    <img class="img-icon-login" src="{{ asset('assets/img/logo-banten.png') }}" data-id="rcti-plus-logo" alt="Bantenprov Logo" />
                    <small>Sign in to start your session</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                @error('login_error')
                <div class="alert alert-danger fade in m-b-15">
                    {{ $message }}
                    <span class="close" data-dismiss="alert">×</span>
                </div>
                @enderror
                <form method="POST" action="{{ route('login') }}" class="margin-bottom-0">
                    @csrf
                    {{-- @captcha --}}
                    <div class="form-group m-b-15">
                        <input id="email" type="email" class="form-control input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="on" autofocus placeholder="Email Address">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group m-b-15">
                        <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" autocomplete="off" placeholder="Password">
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="checkbox m-b-30">
                        <label>
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} /> {{ __('Remember Me') }}
                        </label>
                    </div>
                    <div class="login-buttons m-b-10">
                        <button type="submit" class="btn btn-primary btn-block btn-lg btn-submit">
                            {{ __('Login') }} <i class="fa fa-sign-in"></i>
                        </button>
                    </div>
                    <hr />
                    <p class="text-center">
                        &copy; Bantenprov All Right Reserved {{ date('Y') }}
                    </p>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->
</div>
<!-- end page container -->
@endsection
@section('js')
<script>
    $(document).ready(function() {
        App.init();
    });

    $(document).on("keypress", "input#password", function(e) {
        if (e.which == 13) {
            $("button.btn-submit").click();
        }
    });

    $(document).on("keypress", "input#email", function(e) {
        if (e.which == 13) {
            $("input#password").focus();
        }
    });
</script>
@endsection