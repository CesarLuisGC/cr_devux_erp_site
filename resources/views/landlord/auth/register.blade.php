@extends('landlord.layouts.auth.app')

@section('title', ' | ' . trans('auth.register'))

@section('style')
@endsection

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-75">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-bolder text-info text-gradient">Welcome</h3>
                                    <p class="mb-0">Enter your details to register</p>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('landlord.store') }}">
                                        @csrf
                                        <label>Site Name</label>
                                        @error('sitename')
                                            <label> <span class="text-danger">{{ $message }}</span></label>
                                        @enderror
                                        <div class="mb-3">
                                            <input type="text" name='sitename' class="form-control"
                                                placeholder="Site name" aria-label="Site" value="{{ old('sitename') }}">
                                        </div>
                                        <label>Subdomain</label>
                                        @error('subdomain')
                                            <label> <span class="text-danger">{{ $message }}</span></label>
                                        @enderror
                                        <div class="input-group">
                                            <input type="text" name='subdomain' class="form-control"
                                                value="{{ old('subdomain') }}">
                                            <span></span>
                                            <span class="input-group-text">{{ ' .' . @config('app.url') . ' ' }}</span>
                                        </div>
                                        <label>Name</label>
                                        @error('name')
                                            <label> <span class="text-danger">{{ $message }}</span></label>
                                        @enderror
                                        <div class="mb-3">
                                            <input type="text" name='name' class="form-control"
                                                placeholder="Full name" value="{{ old('name') }}">
                                        </div>
                                        <label>Email</label>
                                        @error('email')
                                            <label> <span class="text-danger">{{ $message }}</span></label>
                                        @enderror
                                        <div class="mb-3">
                                            <input type="email" name='email' class="form-control" placeholder="Email"
                                                value="{{ old('email') }}">
                                        </div>
                                        <label>Password</label>
                                        @error('password')
                                            <label> <span class="text-danger">{{ $message }}</span></label>
                                        @enderror
                                        <div class="mb-3">
                                            <input type="password" name='password' class="form-control"
                                                placeholder="Password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn bg-gradient-info w-100 mt-4 mb-0">Register</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6"
                                    style="background-image:url('{{ asset('assets/creative-tim/media/img/auth/landlord-register.jpg') }}')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('javascript')
@endsection
