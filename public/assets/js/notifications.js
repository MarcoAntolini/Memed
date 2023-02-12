$(function () {
    const notifications = $('#notifications').val();
    const notifiche = $('#notifiche').val();
    if (notifications == 0) {
        $('#readall').prop("disabled", true);
    }
    if (!notifiche) {
        $('#clearall').prop("disabled", true);
    }
});