@extends('users::layouts.app')

@include('users::layouts._partials.breadcrumb_list')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('users::layouts._partials.table_buttons')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                @tip(['tip' => 'table.filters'])

                <div class="table-responsive">

                    @tip(['tip' => 'table.find', 'align' => 'right'])
                    @tip(['tip' => 'table.order'])

                    <table class="table table-striped table-bordered table-hover table-condensed"
                           id="dt_ajx">
                    </table>

                </div>

            </div>
        </div>
    </div>

    @yield('table_info')

@endsection
