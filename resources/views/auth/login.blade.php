@extends('auth.layout.master')
@section('content')
    <img src="{{ asset('frontend/images/dot2.png') }}" class="img-fluid post-img">
    <div class="ripple" style="animation-delay: 0s"></div>
    <!--<section class="position-absolute w-100">
        <div class="container">
        <div class="row m-0">
            <img src="{{ asset('frontend/images/logo.png') }}" width="130px">
        </div>
    </div>
    </section>-->
    
    <div class="container">
        <div class="row h-100 m-0 justify-content-center align-items-center">
            <div class="col-sm-6">
                <div class="sign-in-box">
                    <a href="{{ route('land_page') }}" class="homeicon"><i title="Home Page" class="fa fa-home text-primary fa-2x float-right mr-3 mt-3 shadow-sm text-info"></i></a>
                    <div class="row align-items-center jusify-content-center">
                        <!--<div class="col-lg-5">
                            <img src="{{ asset('frontend/images/sign-in.png') }}" class="img-fluid">
                        </div>-->
                        <div class="col-lg-12 form-div wow fadeInRight">
                            <div class="heading mb-0">
                                <!--<h1>Welcome Back :)</h1>-->
                                <h1>Login</h1>
                            </div>
                            <p class="mb-5">To keep connected with us please login with your personal information by email address
                                and password<span class="ml-3"><img
                                        src="{{ asset('frontend/images/bell.png') }}" class="img-fluid"></span>
                            </p>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form class="cd-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="image-replace cd-email" for="signin-email">E-mail Address</label>
                                        <input class="full-width has-padding has-border" id="signin-email"
                                            type="E-mail Address" placeholder="E-mail" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-sm-12">
                                        <label class="image-replace cd-password" for="signin-password">Password</label>
                                        <input class="full-width has-padding has-border" id="signin-password"
                                            type="password" placeholder="Password" name="password" value="{{ old('password') }}">
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    {{-- <div class="form-group col-sm-6">
                                        <div class="chiller_cb">
                                            <input id="myCheckbox" type="checkbox" checked>
                                            <label for="myCheckbox">Remember Me</label>
                                            <span></span>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="form-group col-sm-6 text-right">
                                        <a href="{{ route('password.request') }}">Forgot password?</a>
                                    </div> --}}
                                </div>

                                <div class="form-row mt-2">
                                    <div class="form-group col-sm-12 text-right">
                                        <button class="btn btn-login mt-2">Login Now</button>
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="d-sm-flex align-items-baseline jusify-content-center mt-4">
                                <div class="flex-fill">
                                    <p>Or you can join with</p>
                                </div>
                                <div>
                                    <ul class="foot-social">
                                        <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-google-plus" aria-hidden="true"></i></li>
                                    </ul>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
