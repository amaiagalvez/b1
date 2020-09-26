@extends('basics::layouts.form_two')

@section('title', trans_choice('users.variable', 1))

@section ('form')

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="{{$field_title}}">{{ trans('basics::users.name') }} </label>
            <input class="form-control" type="text"
                   name="{{$field_title}}" id="{{$field_title}}"
                   value="{{ old('name', $variable->$field_title) }}"
                   disabled>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="value">{{ trans('basics::users.value') }} @asterisk() </label>

            @if($variable->filed_type === \Izt\Basics\Classes\FieldTypes::NUMBER || $variable->filed_type === \Izt\Basics\Classes\FieldTypes::TEXT)
                <input class="form-control @error('value') is-invalid @enderror" type="text"
                       placeholder="{{ trans('basics::users.value') }}" name="value" id="value"
                       value="{{ old('value', $variable->value) }}" autofocus required>

            @elseif($variable->filed_type === \Izt\Basics\Classes\FieldTypes::IMAGE)
                @if($variable->value !== '')
                    <br>
                    <img src="{{ asset('images/'.$variable->value) }}" width="150" alt="{{env('APP_NAME', '')}}">
                @endif
                <input id="value" name="value" type="file" required>

            @elseif($variable->filed_type === \Izt\Basics\Classes\FieldTypes::LONGTEXT)
                <textarea type="text" id="value" name="value"
                          class="ckeditor form-control  @error('value') is-invalid @enderror"
                          required> {{ $variable->value }} </textarea>

            @elseif($variable->filed_type === \Izt\Basics\Classes\FieldTypes::LIST)
                <select name="value[]" class="form-control" required multiple>
                    @foreach(\Izt\Helpers\Classes\Languages::getChoicesArray() AS $language)
                        <option value="{{ $language }}"
                                @if(! is_null(old('value', $variable->value)) && in_array($language, old('value', getArray($variable->value)))) selected="selected" @endif> {{ $language }} </option>
                    @endforeach
                </select>
            @endif

            @error('value')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

@endsection

@section ('info')

    <div class="form-row">
        <div class="form-group col-md-12 card-accent-secondary">
            <span>{{ trans('basics::users.updated') }}
                : {{date($variable->updated_at)}} {{$variable->updatedBy->name ?? ''}}</span>
        </div>
    </div>

@endsection
