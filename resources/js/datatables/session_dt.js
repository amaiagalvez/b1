function initSessionDataTables(list_type, lang, route_index) {

    window.dtOptions = window.dtDefaultOptions;

    let param = window.location.search;
    let dt_url = '';

    window.dtOptions.columns =
        [
            {title: "", data: "actions", name: "actions", orderable: false, searchable: false, width: "1%"},
            {title: sessionWords.user, data: "user.data.name", name: "user.name"},
            {title: sessionWords.login_at, data: "login_at", name: "login_at"},
            {title: sessionWords.logout_at, data: "logout_at", name: "logout_at"},
            {title: sessionWords.total, data: "total", name: "total", orderable: false, searchable: false},
            {title: sessionWords.ip_address, data: "ip_address", name: "ip_address"},
            {title: sessionWords.user_agent, data: "user_agent", name: "user_agent", width: "20%"},
        ];

    if (list_type === 'index') {
        dt_url = route_index + param;
    }

    window.dtOptions.language = lang;
    window.dtOptions.oLanguage.sUrl = "/js/dt_" + lang + ".json";
    window.dtOptions.serverSide = true;
    window.dtOptions.order = [2, 'desc']; //login_at

    window.dtOptions.ajax = dt_url;

    $('#dt_ajx').DataTable(window.dtOptions);
}
