$(document).ready(function() {
    $("#form_software1, #form_software2").keyup(function(){
        var softmain = $(this).val();
        console.log(softmain)
        var elt = $(this);
        var idelt = $(this).attr('id');
        if (softmain.length >=1) {
            $.ajax({
                type: "POST",
                url:"/comparatifs/list/" + softmain,
                dataType: "json",
                timeout: 3000,
                success: function (response){
                    var softmains = JSON.parse(response.data);
                    html = "";
                    for (i = 0; i < softmains.length; i++) {
                        html += "<li>" + softmains[i].name + "</li>";
                    }
                    $('#autocomplete_'+idelt).html(html);

                    $('#autocomplete_'+idelt).find('li').on('click', function() {
                    console.log($('#autocomplete_'+idelt).find('li'))
                            //elt.find('li').on('click', function() {
                        elt.val($(this).text());
                        $('#autocomplete_'+idelt).html('');
                    });
                },
                error: function (){
                    elt.text('Ajax call error');
                }
            })
        } else {
            elt.html('');
        }
    });
});
