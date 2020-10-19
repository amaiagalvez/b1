@extends('basics::layouts._base.app')

@include('basics::layouts._partials.breadcrumb_list')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('basics::layouts._table.table_buttons')
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">

                    <table class="table table-striped table-bordered table-hover table-condensed"
                           id="dt_ajx">
                    </table>

                </div>

            </div>
        </div>
    </div>

    @yield('table_info')

@endsection
