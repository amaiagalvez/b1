@extends('basics::layouts.table')

@section('title', trans_choice('basics::basics.role', 2))

@section('scripts')
    <script>
        $(document).ready(function () {
            let list_type = "{{ $list_type }}";
            let lang = "{{ App::getLocale() }}";
            let route_index = "{{ route('roles.index')  }}";
            let route_trash = "{{ route('roles.trash')  }}";

            initRoleDataTables(list_type, lang, route_index, route_trash);
        });

    </script>
@stop
