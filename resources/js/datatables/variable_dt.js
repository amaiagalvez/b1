function initVariableDataTables(list_type, lang, route_index) {

    window.dtOptions = window.dtDefaultOptions;

    let param = window.location.search;
    let dt_url = '';

    let field_title = 'title_' + lang;
    let field_notes = 'notes_' + lang;

    window.dtOptions.columns =
        [
            {title: "", data: "actions", name: "actions", orderable: false, searchable: false, width: "10%"},
            {title: variableWords.variable, data: field_title, name: field_title, width: "20%"},
            {title: variableWords.value, data: "value", name: "value", className: "text-center"},
            {title: dtWords.notes, data: field_notes, name: field_notes, width: "20%"},
            {title: dtWords.order, data: "order", name: "order", visible: false}
        ];

    if (list_type === 'index') {
        dt_url = route_index + param;
    }

    window.dtOptions.language = lang;
    window.dtOptions.oLanguage.sUrl = "/helpers/js/dt_" + lang + ".json";
    window.dtOptions.serverSide = true;
    window.dtOptions.order = [4, 'asc']; //order

    window.dtOptions.ajax = dt_url;

    $('#dt_ajx').DataTable(window.dtOptions);
}
