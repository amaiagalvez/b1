@extends('layouts._table.table')

@section('title', trans_choice('basics::basics.session', 2))

@section('scripts')
    <script>
        $(document).ready(function () {
            let list_type = "{{ $list_type }}";
            let lang = "{{ App::getLocale() }}";

            let route_index = "{{ route('sessions.index')  }}";

            initSessionDataTables(list_type, lang, route_index);

            $('#search_user').on('change', function (e) {
                e.preventDefault();
                let search_user = $('#search_user').val();
                let url = '?search_user=' + search_user;

                window.location = url;
            });
        });

    </script>
@stop
