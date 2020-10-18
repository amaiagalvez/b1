@extends('layouts._table.table')

@section('title', trans_choice('basics::basics.variable', 2))

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
