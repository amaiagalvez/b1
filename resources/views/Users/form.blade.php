@extends('basics::layouts.form_two')

@section('title', trans_choice('basics::basics.user', 1))

@section ('form')

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">{{ trans('basics::basics.name') }} @asterisk() </label>
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
            <label for="email">{{ trans('basics::basics.email') }} @asterisk() </label>
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
            <label for="lang">{{ trans('basics::basics.lang') }} @asterisk() </label>
            <select id="lang" name="lang" class="form-control @error('lang') is-invalid @enderror" required>
                <option value="">--</option>
                @foreach($languages AS $key => $language)
                    <option value="{{ $language }}"
                            @if(! is_null(old('lang', $user->lang)) && $language === old('lang', $user->lang)) selected="selected" @endif> {{ $language }} </option>
                @endforeach
            </select>

            @error('lang')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="lang">{{ trans('basics::basics.role_name') }} @asterisk() </label>
            <select id="role_name" name="role_name" class="form-control @error('role_name') is-invalid @enderror"
                    required>
                @foreach($roles AS $key => $role)
                    <option value="{{ $key }}"
                            @if(! is_null(old('role_name', $user->role_name)) && $key === old('role_name', $user->role_name)) selected="selected" @endif> {{ $role }} </option>
                @endforeach
            </select>

            @error('role_name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">{{ trans('basics::basics.password') }} </label>
            <input class="form-control @error('password') is-invalid @enderror" type="password"
                   name="password" id="password">

            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="name">{{ trans('basics::basics.password_confirmation') }} </label>
            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                   name="password_confirmation" id="password_confirmation">

            @error('password_confirmation')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="notes">{{ trans('basics::basics.notes') }} </label>

            <textarea type="text" id="notes" name="notes"
                      class=" form-control  @error('notes') is-invalid @enderror"> {{ $user->notes }} </textarea>
            @error('notes')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

@endsection

@section ('info')

    <div class="form-row">
        <div class="form-group col-md-12 card-accent-secondary">
            <span>{{ trans('helpers::action.created') }}: {{date($user->created_at)}} {{$user->createdBy->name ?? ''}}</span>
            <br>
            <span>{{ trans('helpers::action.updated') }}: {{date($user->updated_at)}} {{$user->updatedBy->name ?? ''}}</span>
        </div>
    </div>

@endsection

@include('basics::Users.form_right')
