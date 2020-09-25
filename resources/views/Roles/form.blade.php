@extends('users::layouts.form_two')

@section('title', trans_choice('users.role', 1))

@section ('form')

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">{{ trans('users::users.name') }}  </label>
            <input class="form-control @error('name') is-invalid @enderror" type="text"
                   name="name" id="name"
                   value="{{ old('name', $role->name) }}"
                   required autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="title">{{ trans('users::users.title') }} </label>
        </div>
        @foreach($languages AS $lang)
            @php $title = 'title_'.$lang @endphp
            <div class="form-group col-md-6">
                <label for="title_{{$lang}}"> {{mb_strtoupper($lang)}} </label>
                <input class="form-control @error('title_'.$lang) is-invalid @enderror" type="text"
                       name="title_{{$lang}}" id="title_{{$lang}}"
                       value="{{ old('title_'.$lang, $role->$title) }}">

                @error('title_'.$lang)
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        @endforeach

    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="modules">{{ trans_choice('users.module', 2) }}  </label>
            <select name="modules[]" class="form-control" required multiple size="{{count($modules)}}">
                @foreach($modules AS $module)
                    <option value="{{ $module->id }}"
                            @if(!is_null(old('modules', $role_modules)) && in_array($module->id, old('modules', $role_modules))) selected="selected" @endif> {{ $module->name }} </option>
                @endforeach
            </select>
            @error('modules')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="notes">{{ trans('users::users.notes') }} </label>
            @foreach($languages AS $lang)
                @php $notes = 'notes_'.$lang @endphp
                <div class="form-group col-md-12">
                    <label for="title_{{$lang}}"> {{mb_strtoupper($lang)}} </label>
                    <textarea type="text" id="{{$notes}}" name="{{$notes}}" rows="1"
                              class=" form-control  @error('notes_'.$lang) is-invalid @enderror"> {{ $role->$notes }} </textarea>
                    @error('notes_'.$lang)
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section ('info')
    <div class="form-row">
        <div class="form-group col-md-12 card-accent-secondary">
            <span>{{ trans('users::users.created') }}: {{date($role->created_at)}}</span>
            {{--            $role->createdBy->name ?? ''--}}
            <br>
            <span>{{ trans('users::users.updated') }}: {{date($role->updated_at)}}</span>
            {{--            $role->updatedBy->name ?? ''--}}
        </div>
    </div>
@endsection

@include('users::Roles.form_right')
