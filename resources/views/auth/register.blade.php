@extends('layouts.regis')

@section('pagetitle')
CampBS Register
@endsection

@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                <div class="d-flex justify-content-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                        <!-- <img src="assets/img/logo.png" alt=""> -->
                        <span class="d-none d-lg-block">CampBS</span>
                    </a>
                </div><!-- End Logo -->

                <div class="card mb-3">

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="pt-4 pb-2">
                            <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                            <p class="text-center small">Enter your personal details to create account</p>
                        </div>

                        <form class="row g-3 needs-validation" novalidate>
                            <div class="col-12">
                                <label for="name" class="form-label">{{ __('Name') }}<span style="color: red">*</span></label>
                                
                                <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label for="address" class="form-label">{{ __('Address') }}<span style="color: red">*</span></label>
                                
                                <div class="col-md-12">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label for="phonenum" class="form-label">{{ __('Phone Number') }}<span style="color: red">*</span></label>
                                
                                <div class="col-md-12">
                                <input id="phonenum" type="text" class="form-control @error('phonenum') is-invalid @enderror" name="phonenum" value="{{ old('phonenum') }}" required autocomplete="phonenum" autofocus>

                                @error('phonenum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label for="email" class="form-label">{{ __('Email Address') }}<span style="color: red">*</span></label>
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
                                
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label for="password" class="form-label">{{ __('Password') }}<span style="color: red">*</span></label>
                                <input id="password" type="password"  class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12 mt-4">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}<span style="color: red">*</span></label>
                                <input id="password-confirm" type="password"  class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary w-100" type="submit">{{ __('Register') }}</button>
                            </div>
                            <br>
                            <div class="col-12">
                                <p class="small mb-0">Already have an account? <a href="{{ route('login') }}">Log in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection