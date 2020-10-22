@extends('basics::layouts._base.app_clean')

@section('title', trans('basics::auth.register'))

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card-group">
                    <div class="card p-4">
                        <div class="card-body">
                            <h3>{{ trans('basics::auth.register') }}</h3>
                            <p class="text-muted"></p>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           placeholder="{{ trans('basics::auth.name') }}" name="name" id="name"
                                           value="{{ old('name') }}" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

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

                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">
                                        <i class="fas fa-unlock-alt"></i>
                                      </span>
                                    </div>

                                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                           type="password"
                                           placeholder="{{ trans('basics::auth.password_confirmation') }}"
                                           name="password_confirmation"
                                           id="password_confirmation">

                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-4 ml-2">
                                    <div class="form-check">
                                        <input type='hidden' value='0' name='show_profile'>
                                        <input class="form-check-input" type="checkbox" id="show_profile"
                                               name="show_profile" value="1"
                                               @if(old('show_profile') == 1) checked="checked" @endif />
                                        <label class="ml-3 form-check-label" for="active">
                                            {{ trans('basics::auth.show_profile') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" id="register-btn"
                                                type="submit">{{ trans('basics::auth.register') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
