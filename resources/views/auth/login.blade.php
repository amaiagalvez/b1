@extends('basics::layouts._base.app_clean')

@section('title', trans('basics::auth.login_in'))

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h3>{{ trans('basics::auth.login_in') }}</h3>
                            <p class="text-muted"></p>
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-at"></i>
                                        </span>
                                    </div>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email"
                                           placeholder="{{ trans('basics::auth.email') }}" name="email" id="email"
                                           value="{{ old('email') }}" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fas fa-unlock-alt"></i>
                                      </span>
                                    </div>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                           placeholder="{{ trans('basics::auth.password') }}" name="password"
                                           id="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" id="login-btn"
                                                type="submit">{{ trans('basics::auth.login') }}</button>
                                    </div>
                                </div>

                                <div class="form-group mt-5">
                                    <div class="d-flex no-block">
                                        <div>
                                            <a href="{{ route('password.request') }}" id="to-recover"
                                               class="text-muted"><i
                                                        class="fa fa-lock m-r-5"></i> {{ trans('basics::auth.forgot_password') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        @if(config('basics.oauth', false))
                            <div class="card-footer text-center">
                                <a href="{{route('login.social', 'twitter')}}" class="btn btn-twitter"><i
                                            class="fab fa-twitter"></i> Twitter </a>
                                <a href="{{route('login.social', 'facebook')}}" class="btn btn-facebook"><i
                                            class="fab fa-facebook-square"></i> Facebook </a>
                                <a href="{{route('login.social', 'google')}}" class="btn btn-reddit"><i
                                            class="fab fa-google"></i> Google </a>
                            </div>
                        @endif
                    </div>
                    <div class="card text-white py-5 d-md-down-none" style="width:44%">
                        <div class="card-body text-center">
                            <div>
                                <p><img src="{{ asset('images/logo.png') }}" width="250" alt="{{env('APP_NAME', '')}}">
                                </p>
                                <h1 class="theme-title">
                                    <a href="{{route('front.home')}}"
                                       class="not-text-decoration theme-color">{{$app_name}}</a>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
