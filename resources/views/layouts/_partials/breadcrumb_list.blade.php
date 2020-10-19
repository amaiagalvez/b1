@section('breadcrumb_list')
    <div class="c-subheader px-3">
        <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">
                <a href="{{route('basics.home')}}" class="not-text-decoration">{{trans('basics::action.home')}}</a>
            </li>

            @foreach($breadcrumbs AS $breadcrumb)
                <li class="breadcrumb-item @if ($loop->last) active @endif">
                    <a href="{{ $breadcrumb['route'] ?? '#' }}" class="not-text-decoration">
                        {{ $breadcrumb['title'] ?? ''}}
                    </a>
                </li>
            @endforeach
        </ol>
    </div>

@endsection
