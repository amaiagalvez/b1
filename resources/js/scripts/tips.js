/* Dismissable tips */

$(document).on("click", "a.dismiss-tip", function () {
    let link = $(this);
    link.hide();

    let data = {
        tip: link.data("tip"),
        _token: $('meta[name="csrf-token"]').attr('content')
    };

    $.post("/dismissible-tips/dismiss", data);

    return false;
});
