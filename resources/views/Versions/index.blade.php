@extends('basics::layouts._base.app')

@section('title', trans_choice('basics::basics.version', 2))

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
                <div class="card-body">
                    <div class="accordion" id="accordion" role="tablist">
                        @foreach($versions AS $version)
                            <div class="card mb-0">
                                <div class="card-header" id="heading{{$version['id']}}" role="tab">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse{{$version['id']}}"
                                           aria-expanded="true"
                                           aria-controls="collapseOne" class="not-text-decoration">
                                            {!! label($version['application']) !!} {!! label($version['name']) !!}
                                        </a>
                                        <small
                                                style="float: right">{{$version['created_at']}}</small>
                                    </h5>
                                </div>
                                <div class="collapse @if ($loop->last) show @endif" id="collapse{{$version['id']}}"
                                     role="tabpanel" aria-labelledby="heading{{$version['id']}}"
                                     data-parent="#accordion" style="">
                                    <div class="card-body">
                                        {!! $version['notes']  !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
@endsection
