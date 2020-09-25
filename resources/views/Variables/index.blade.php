@extends('users::layouts.table')

@section('title', trans_choice('users.variable', 2))

@section('scripts')

    <script>
        $(document).ready(function () {
            let list_type = "{{ $list_type }}";
            let lang = "{{ App::getLocale() }}";

            let route_index = "{{ route('variables.index')  }}";

            initVariableDataTables(list_type, lang, route_index);
        });
    </script>
@stop
