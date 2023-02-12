$(function() {
    $("#search-form").submit(function(event) {
        if ($("#search").val() === "") {
            event.preventDefault()
        }
    })
})