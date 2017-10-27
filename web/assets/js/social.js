$(document).ready(function () {
    $('#share a:last-child').click(function () {
        $('#share a').not(':last-child').toggleClass('hidden show');
    })
})