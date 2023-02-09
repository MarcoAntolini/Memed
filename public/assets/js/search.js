$(function() {
    $(".followBtn").on('click', function() {
        let button = $(this);
        let username = button.attr('id');

        $.ajax({
            url: "updateFollow.php",
            type: "post",
            data: { "username": username },
            success: function(e) {
                if (e == "following") {
                    button.html("Non seguire più");
                } else if (e == "not following") {
                    button.html("Segui");
                }
            }
        })
    })
})