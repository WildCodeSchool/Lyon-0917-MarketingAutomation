$(document).ready(function() {
    var showChar = 150;
    var ellipsestext = "...";
    $('.troncate').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);


            var html = c + ellipsestext;
            $(this).html(html);
        }

    });
});