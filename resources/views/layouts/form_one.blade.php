@extends('users::layouts.app')

@include('users::layouts._partials.breadcrumb_list')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @include('users::layouts._partials.table_buttons')
            </div>
        </div>

        @include('users::layouts._partials.validation_errors')
        {{--        TODO: kendu hau--}}

        <div class="row">
            <div class="col-md-12">

                <form method="{{$form['method']}}" action="{{ $form['action'] }}" enctype="multipart/form-data">
                    @csrf

                    @yield('form')

                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-primary px-4" type="submit">
                                {{ $form['button'] }}
                            </button>
                        </div>
                    </div>

                </form>

                <div class="col-md-6 my-5">
                    @yield('info')

                    @tip(['tip' => 'form.info'])
                </div>

            </div>
        </div>
    </div>
@endsection
