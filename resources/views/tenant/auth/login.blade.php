@extends('tenant.layouts.auth.app')

@section('title', ' | ' . trans('auth.login'))

@section('style')
@endsection

@section('content')
    <div class="page-header min-vh-85">
        <div>
            <img class="position-absolute fixed-top ms-auto w-50 h-100 z-index-0 d-none d-sm-none d-md-block border-radius-section border-top-end-radius-0 border-top-start-radius-0 border-bottom-end-radius-0"
                src="{{ asset('assets/creative-tim/media/img/auth/tenant-login.jpg') }}" alt="image">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                    <div class="card card-plain mt-8">
                        <div class="card-header pb-0 text-left bg-transparent">
                            <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                            <p class="mb-0">Enter your email and password to sign in</p>
                        </div>
                        <div class="card-body">
                            <form class="form w-100" novalidate="novalidate" id="login_form" method="POST"
                                action="{{ route('landlord.authenticate') }}">
                                @csrf

                                <label>Email</label>
                                @error('email')
                                    <label> <span class="text-danger">{{ $message }}</span></label>
                                @enderror
                                <div class="mb-3">
                                    <input type="email" name='email' class="form-control" placeholder="Email"
                                        aria-label="Email" aria-describedby="email-addon">
                                </div>
                                <label>Password</label>
                                @error('password')
                                    <label> <span class="text-danger">{{ $message }}</span></label>
                                @enderror
                                <div class="mb-3">
                                    <input type="password" name='password' class="form-control" placeholder="Password"
                                        aria-label="Password" aria-describedby="password-addon">
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">
                                        @lang('auth.login')</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <p class="mb-4 text-sm mx-auto">
                                Don't have an account?
                                <a href="{{ route('landlord.register') }}" class="text-info text-gradient font-weight-bold">
                                    @lang('auth.register')</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 d-flex justify-content-center flex-column">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
