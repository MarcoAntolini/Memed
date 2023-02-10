$(function () {
    $(".followBtn").on('click', function () {
        let button = $(this);
        let username = button.attr('id');

        $.ajax({
            url: "updateFollow.php",
            type: "post",
            data: { "username": username },
            success: function (e) {
                if (e == "follow") {
                    button.html("Smetti di seguire");
                } else if (e == "unfollow") {
                    button.html("Segui");
                }
            }
        });
    });
});