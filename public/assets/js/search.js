$(document).ready(function() {
    $('#search').keypress(function(e) {
        if (e.keyCode === 13) {
            console.log($('#search').val());
        }
    })
})