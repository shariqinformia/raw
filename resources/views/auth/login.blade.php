@extends('layouts.auth')

@section('title', 'Login')


@section('main')
    <style>
        .loginPageWrapper .login-box {
            width: 100%;
            padding: 0vw 4vw;
        }

        .loginPageWrapper .card {
            box-shadow: unset;
        }

        .loginPageWrapper .loginBg {
            min-height: 560px;
        }

        .loginPageWrapper .col-md-5.col-lg-5.col-12.bg-white {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loginPageWrapper .card-body.login-card-body {
            padding: 0;
        }

        .loginBg {
            background: url('') no-repeat cover center center;
        }

        .loginPageWrapper .loginText {
            font-size: 35px;
            font-weight: 900;
            text-shadow: 0px 4px 3px rgb(0 0 0 / 20%), 0px 8px 13px rgba(0, 0, 0, 0.1), 0px 18px 23px rgba(0, 0, 0, 0.1);
            color: #292a5c;
            margin-bottom: 50px;
        }

        .loginPageWrapper input.form-control {
            border: none;
            background: #0000 !important;
            border-radius: 0;
            border-bottom: solid 1px #ccc;
        }

        .loginPageWrapper .login-box .icheck-primary {
            margin: 30px 0px !important;
        }

        .loginBgImg {
            display: none;
        }

        @media (max-width:767px) {
            .loginPageWrapper .loginPageInner>.container .row {
                flex-direction: column-reverse;
            }

            .loginPageWrapper .loginPageInner>.container .row .loginBg {
                background: unset !important;
                min-height: auto !important;
            }

            .loginPageInner {
                padding-top: 60px;
            }

            .loginPageWrapper .login-box button.btn.btn-primary.btn-block {
                background: #0a043d;
                border: none;
            }

            .loginPageWrapper .login-box {
                padding: 50px 30px;
                width: 100%;
            }

            .loginBgImg {
                display: block;
            }
        }

        @media (max-width:991px) {
            .loginPageWrapper .loginBg {
                min-height: 430px;
            }
        }
    </style>

    <div class="loginPageWrapper w-100">
        <div class="loginPageInner">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-12 bg-white ">
                        <div class="login-box">
                            <div class="loginText">
                                {{ __('Login') }}
                            </div>
                            <!-- /.login-logo -->
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Email" value="{{ old('email') }}" autofocus required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="icheck-primary">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label" for="remember">
                                                {{ __('Remember') }}
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            {{ __('Login') }}
                                        </button>
                                    </form>
                                </div>
                                <!-- /.login-card-body -->
                            </div>
                            <br>
{{--                            @if (Route::has('password.request'))--}}
                                <a href="{{ route('password.request') }}">
                                    <i class="fa fa-question-circle"></i>
                                    {{ __('Forgot password?') }}
                                </a>
{{--                            @endif--}}
                        </div>
                    </div>
{{--                    <div class="col-md-7 col-lg-7 col-12 loginBg"--}}
{{--                        style="background:url({{ asset('/images/loginBgImg.png') }}) no-repeat center center/cover">--}}
{{--                        <img src="{{ asset('/images/loginBgImg.png') }}" class="img-fluid loginBgImg" alt="">--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
