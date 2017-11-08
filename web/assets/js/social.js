$(document).ready(function () {
    $('#share a:last-child').click(function () {
        $('#share a').not(':last-child').toggleClass('hidden show');
    })

    $('a.social').click(function () {
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    })
})