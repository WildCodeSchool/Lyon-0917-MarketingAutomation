var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight,
    html.clientHeight, html.scrollHeight, html.offsetHeight );

$(window).scroll(function() {
    if($(this).scrollTop()>(height/5))
    {
        $('#topFixed').fadeIn().removeClass("hide");
    }
    else
    {
        $('#topFixed').fadeOut();
    }
});