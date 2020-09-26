function initUserDataTables(list_type, lang, route_index, route_trash, route_nonactive) {

    window.dtOptions = window.dtDefaultOptions;

    let param = window.location.search;
    let dt_url = '';

    window.dtOptions.columns =
        [
            {title: "", data: "actions", name: "actions", orderable: false, searchable: false, width: "10%"},
            {title: userWords.name, data: "name", name: "name"},
            {title: userWords.email, data: "email", name: "email"},
            {title: dtWords.lang, data: "lang", name: "lang", className: "text-center"},
            {title: userWords.role_name, data: "role_name", name: "role_name", className: "text-center"},
            {
                title: userWords.sessions_count,
                data: "sessions_count",
                name: "sessions_count",
                searchable: false,
                className: "text-center"
            },
            {title: dtWords.notes, data: "notes", name: "notes", width: "20%"}
        ];

    if (list_type === 'index') {
        dt_url = route_index + param;
    }

    if (list_type === 'trash') {
        dt_url = route_trash + param;

        window.dtOptions.columns.push(
            {title: dtWords.when, data: "deleted_at", name: "deleted_at"},
            {
                title: dtWords.who,
                data: "deletedBy.data.name",
                name: "deletedBy.name",
                orderable: false,
                searchable: false
            }
        );
    }

    if (list_type === 'nonactive') {
        dt_url = route_nonactive + param;

        window.dtOptions.columns.push(
            {title: dtWords.when, data: "updated_at", name: "updated_at"},
            {
                title: dtWords.who,
                data: "updatedBy.data.name",
                name: "updatedBy.name",
                orderable: false,
                searchable: false
            }
        );
    }

    window.dtOptions.language = lang;
    window.dtOptions.oLanguage.sUrl = "/js/dt_" + lang + ".json";
    window.dtOptions.serverSide = true;
    window.dtOptions.order = [1, 'asc']; //name

    window.dtOptions.ajax = dt_url;

    $('#dt_ajx').DataTable(window.dtOptions);
}
