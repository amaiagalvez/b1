@extends('basics::layouts._base.app')

@include('basics::layouts._partials.breadcrumb_list')

@section('content')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @include('basics::layouts._table.table_buttons')
            </div>
        </div>

        @include('basics::layouts._form.validation_errors')

        <div class="row">
            <div class="col-md-12">

                <form method="POST" action="{{ $form['action'] }}" enctype="multipart/form-data">
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
                </div>

            </div>
        </div>
    </div>
@endsection
