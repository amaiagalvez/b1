@extends('basics::layouts.form_two')

@section('title', trans_choice('users.profile', 1))

@section ('form')

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">{{ trans('basics::users.name') }} @asterisk() </label>
            <input class="form-control @error('name') is-invalid @enderror" type="text"
                   name="name" id="name"
                   value="{{ old('name', $user->name) }}"
                   required autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="email">{{ trans('basics::users.email') }} @asterisk() </label>
            <input class="form-control @error('email') is-invalid @enderror" type="email"
                   name="email" id="email"
                   value="{{ old('email', $user->email) }}"
                   required>

            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="lang">{{ trans('basics::users.lang') }} @asterisk() </label>
            <select id="lang" name="lang" class="form-control @error('lang') is-invalid @enderror" required>
                <option value="">--</option>
                @foreach($languages AS $language)
                    <option value="{{ $language }}"
                            @if(! is_null(old('lang', $user->lang)) && $language === old('lang', $user->lang)) selected="selected" @endif> {{ $language }} </option>
                @endforeach
            </select>

            @error('lang')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <input id="role_name" name="role_name" value="{{$user->role_name}}" type="hidden">

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">{{ trans('basics::users.password') }} </label>
            <input class="form-control @error('password') is-invalid @enderror" type="password"
                   name="password" id="password">

            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="name">{{ trans('auth.password_confirmation') }} </label>
            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                   name="password_confirmation" id="password_confirmation">

            @error('password_confirmation')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

@endsection

@section ('info')

    <div class="form-row">
        <div class="form-group col-md-12 card-accent-secondary">
            <span>{{ trans('basics::users.created') }}: {{date($user->created_at)}} {{$user->createdBy->name ?? ''}}</span>
            <br>
            <span>{{ trans('basics::users.updated') }}: {{date($user->updated_at)}} {{$user->updatedBy->name ?? ''}}</span>
        </div>
    </div>

@endsection

@include('basics::Users.form_right')
