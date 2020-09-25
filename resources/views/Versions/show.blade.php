@extends('users::layouts.app')

@section('title', trans_choice('users.version', 2))

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
                <div class="card-body">
                    <div class="accordion" id="accordion" role="tablist">
                        @foreach($versions AS $version)
                            <div class="card mb-0">
                                <div class="card-header" id="heading{{$version['id']}}" role="tab">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse{{$version['id']}}"
                                           aria-expanded="true"
                                           aria-controls="collapseOne" class="not-text-decoration">
                                            {!! label($version['name']) !!} {{$version['notes']}}
                                        </a>
                                        <small
                                                style="float: right">{{$version['created_at']}}</small>
                                    </h5>
                                </div>
                                <div class="collapse @if ($loop->last) show @endif" id="collapse{{$version['id']}}"
                                     role="tabpanel" aria-labelledby="heading{{$version['id']}}"
                                     data-parent="#accordion" style="">
                                    <div class="card-body">
                                        @foreach($version['subversions'] AS $subversion)
                                            <br> <i class="fas fa-check"></i> {{$subversion->present()->notes}}
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
