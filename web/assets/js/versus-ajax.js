$(document).ready(function() {
    $("#appbundle_list_softmain").keyup(function(){
        var softmain = $(this).val();
        if (softmain.length >=2) {
            $.ajax({
                type: "POST",
                url:"/comparatifs/" + softmain,
                dataType: "json",
                timeout: 3000,
                success: function (response){
                    var softmains = JSON.parse(response.data);
                    html = "";
                    for (i = 0; i < softmains.length; i++) {
                        html += "<li>" + softmains[i].softmain + "</li>";
                    }
                    $('#autocomplete').html(html);
                    $('#autocomplete li').on('click', function() {
                        $('#appbundle_list_softmain').val($(this).text());
                        $('#autocomplete').html('');
                    });
                },
                error: function (){
                    $('#autocomplete').text('Ajax call error');
                }
            })
        } else {
            $('#autocomplete').html('');
        }
    });
});
