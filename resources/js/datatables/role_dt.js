function initRoleDataTables(list_type, lang, route_index, route_nonactive, route_trash) {

    window.dtOptions = window.dtDefaultOptions;

    let param = window.location.search;
    let dt_url = '';

    let field_title = 'title_' + lang;
    let field_notes = 'notes_' + lang;

    window.dtOptions.columns =
        [
            {title: "", data: "actions", name: "actions", orderable: false, searchable: false, width: "10%"},
            {title: roleWords.rola, data: field_title, name: field_title},
            {title: roleWords.short_name, data: "name", name: "name"},
            {title: dtWords.notes, data: field_notes, name: field_notes, width: "20%"}
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
    window.dtOptions.oLanguage.sUrl = "/basics/js/dt_" + lang + ".json";
    window.dtOptions.serverSide = true;
    window.dtOptions.order = [1, 'asc']; //name

    window.dtOptions.ajax = dt_url;

    $('#dt_ajx').DataTable(window.dtOptions);
}
