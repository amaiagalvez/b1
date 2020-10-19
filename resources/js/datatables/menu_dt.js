function initMenuDataTables(list_type, lang, route_index) {

    window.dtOptions = window.dtDefaultOptions;

    let param = window.location.search;
    let dt_url = '';

    window.dtOptions.columns =
        [
            {title: "", data: "actions", name: "actions", orderable: false, searchable: false, width: "10%"},
            {title: menuWords.id, data: id, name: id, width: "20%"},
            {title: menuWords.name, data: name, name: name, width: "20%"},
            {title: dtWords.order, data: "order", name: "order", visible: false}
        ];

    if (list_type === 'index') {
        dt_url = route_index + param;
    }

    window.dtOptions.language = lang;
    window.dtOptions.oLanguage.sUrl = "/basics/js/dt_" + lang + ".json";
    window.dtOptions.serverSide = true;
    window.dtOptions.order = [1, 'asc']; //id

    window.dtOptions.ajax = dt_url;

    $('#dt_ajx').DataTable(window.dtOptions);
}
