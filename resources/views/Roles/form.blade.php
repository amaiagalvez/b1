@extends('helpers::layouts._form.form_one')

@section('title', trans_choice('basics::basics.role', 1))

@section ('form')

    <div class="form-row">
        <div class="form-group col-md-12">
            <label for="name">{{ trans('basics::basics.name') }} @asterisk</label>
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
            <label for="title">{{ trans('basics::basics.title') }} </label>
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
            <label for="notes">{{ trans('basics::basics.notes') }} </label>
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

    @include('helpers::layouts._form.form_info', ['register' => $role])

@endsection
