$(function() {
    $(".followBtn").on('click', function() {
        console.log(this.id);
        $.get("search-view.php", { query: 'search-view.php'}, function(data) {
            console.log(data);
        });
    });
})