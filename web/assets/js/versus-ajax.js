$(document).ready(function() {
    $("#form_software1").keyup(function(){
        var softmain = $(this).val();
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
                    $('#autocomplete').html(html);
                    $('#autocomplete li').on('click', function() {
                        $('#form_software1').val($(this).text());
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

$(document).ready(function() {
    $("#form_software2").keyup(function(){
        var softmain = $(this).val();
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
                    $('#autocomplete2').html(html);
                    $('#autocomplete2 li').on('click', function() {
                        $('#form_software2').val($(this).text());
                        $('#autocomplete2').html('');
                    });
                },
                error: function (){
                    $('#autocomplete2').text('Ajax call error');
                }
            })
        } else {
            $('#autocomplete2').html('');
        }
    });
});
