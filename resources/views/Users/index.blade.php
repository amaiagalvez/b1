@extends('basics::layouts.table')

@section('title', trans_choice('users.user', 2))

@section('scripts')

    <script>
        $(document).ready(function () {
            let list_type = "{{ $list_type }}";
            let lang = "{{ App::getLocale() }}";

            let route_index = "{{ route('users.index')  }}";
            let route_trash = "{{ route('users.trash')  }}";
            let route_nonactive = "{{ route('users.nonactive')  }}";

            initUserDataTables(list_type, lang, route_index, route_trash, route_nonactive);
        });
    </script>
@stop
