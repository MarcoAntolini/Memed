$(function () {
    const notifications = $('#notifications').val();
    if (notifications == 0) {
        $('#clearall').prop("disabled", true);
        $('#readall').prop("disabled", true);
    }
});