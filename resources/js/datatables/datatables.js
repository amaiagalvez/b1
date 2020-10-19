var footerTotal = "";

var height_content = document.body.offsetHeight / 2;
if (height_content > 550) height_content = 550;
height_content = height_content + 'px';

var handleCheckboxes = function (html, rowIndex, colIndex, cellNode) {
    var $cellNode = $(cellNode);
    var $check = $cellNode.find(':checked');
    return ($check.length) ? ($check.val() === 1 ? 'Yes' : 'No') : $cellNode.text();
};

window.dtDefaultOptions = {
    oLanguage: {
        sUrl: '/js/dt_translations_eu.js'
    },
    scrollX: true, //scroll horizontal
    scrollY: height_content,
    scrollCollapse: true,
    retrieve: true,
    processing: true,
    deferRender: true,
    dom: '<<"top"fr><t><"bottom"Blip>>',
    responsive: true,

    aaSorting: [],
    // fixedColumns:   {
    //     leftColumns: 2
    // },
    select: true,
    stateSave: true,

    iDisplayLength: 10,
    pageLength: 10,
    aLengthMenu: [[10, 20, 25, 50, 100, -1], [10, 20, 25, 50, 100, "All"]],
    pagingType: "full_numbers",

    footerCallback: function (row, data, start, end, display) {
        var api = this.api(), data;

        var rowValue = function (i) {
            return typeof i === 'string' ? i.replace(/[\€.]/g, '').replace(',', '.') * 1 : typeof i === 'number' ? i : 0;
        };

        if (footerTotal != "") {
            footerTotal = footerTotal + ""; //split erabili ahal izateko
            var columnNames = footerTotal.split(",");
            for (var k = 0; k < columnNames.length; k++) {
                // Total over all pages
                columnNb = columnNames[k];

                total = api
                    .column(columnNb)
                    .data()
                    .reduce(function (a, b) {
                        return rowValue(a) + rowValue(b);
                    }, 0);

                // Total over this page
                showTotal = api
                    .column(columnNb, {page: 'current'})
                    .data()
                    .reduce(function (a, b) {
                        return rowValue(a) + rowValue(b);
                    }, 0);

                // Update footer
                showTotal = Number(showTotal).toFixed(2);
                // showTotal = showTotal.replace('.', ',');

                dezimalak = showTotal.split(".");
                if (dezimalak[1] == 0) showTotal = dezimalak[0];

                totala = Number(total).toFixed(2);
                // totala = totala.replace('.', ',');

                dezimalak = totala.split(".");
                if (dezimalak[1] == 0) totala = dezimalak[0];

                $(api.column(columnNb).footer()).html(
                    '<span class="theme-color">' + formatuakZbkia(showTotal) + ' (' + formatuakZbkia(totala) + ')</span>'
                );
            }
        }
    },

    buttons: [
        {
            extend: 'colvis',
            autoClose: true,
            postfixButtons: ['colvisRestore'],
            text: '<i class="fas fa-columns" aria-hidden="true"></i> Zutabeak',
            collectionLayout: 'two-column',
            columns: ':not(:first-child):not(:last-child)'
        },
        {
            extend: 'csv',
            text: '<i class="fas fa-file-csv" aria-hidden="true"></i> CSV ',
            charset: 'utf-8',
            bom: true,
            exportOptions: {
                columns: ':visible',
                modifier: {
                    order: 'applied',  // 'current', 'applied', 'index',  'original'
                    page: 'all',      // 'all',     'current'
                    search: 'applied'     // 'none',    'applied', 'removed'
                }
            }
        }
    ]
};

$('.datatable').each(function () {
    if ($(this).hasClass('dt-select')) {
        window.dtDefaultOptions.select = {
            style: 'multi',
            selector: 'td:first-child'
        };

        window.dtDefaultOptions.columnDefs.push({
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        });
    }

    // $(this).dataTable(window.dtDefaultOptions);
});

if (typeof window.route_mass_crud_entries_destroy != 'undefined') {
    $('.datatable, .ajaxTable').siblings('.actions').html('<a href="' + window.route_mass_crud_entries_destroy + '" class="btn btn-xs btn-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>');
}

$(document).on('click', '.js-delete-selected', function () {
    if (confirm('Are you sure')) {
        var ids = [];

        $(this).closest('.actions').siblings('.datatable, .ajaxTable').find('tbody tr.selected').each(function () {
            console.log("selected", $(this).data('entry-id'));
            ids.push($(this).data('entry-id'));
        });

        $.ajax({
            method: 'POST',
            url: $(this).attr('href') + '/?ids=' + ids,
        }).done(function () {
            location.reload();
        });
    }

    return false;
});

$(document).on('click', '#select-all', function () {
    var selected = $(this).is(':checked');

    $(this).closest('table.datatable, table.ajaxTable').find('td:first-child').each(function () {
        if (selected != $(this).closest('tr').hasClass('selected')) {
            $(this).click();
        }
    });
});

$('.mass').click(function () {
    if ($(this).is(":checked")) {
        $('.single').each(function () {
            if ($(this).is(":checked") == false) {
                $(this).click();
            }
        });
    } else {
        $('.single').each(function () {
            if ($(this).is(":checked") == true) {
                $(this).click();
            }
        });
    }
});

