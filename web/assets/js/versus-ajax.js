$(document).ready(function() {

    $('#autocomplete_form_software1 li').on('click',function(){
    });


    let tab = [];


    $("#compare_software1, #compare_software2").keyup(function(){
        let softmain = $(this).val();
        if (tab.length >= 2) {
             tab = [];
        }
        let elt = $(this);
        let idelt = $(this).attr('id');
        if (softmain.length >=1) {
            $.ajax({
                type: "POST",
                url:"/comparatifs/list/" + softmain,
                dataType: "json",
                timeout: 3000,
                success: function (response){
                    let softmains = JSON.parse(response.data);

                    html = "";
                    for (i = 0; i < softmains.length; i++) {
                        if (tab.indexOf(softmains[i].name) === -1) {
                            html += "<li>" + softmains[i].name + "</li>";
                        } else {
                        }
                    }
                    $("#autocomplete_"+idelt).html(html);

                    $('#autocomplete_'+idelt).find('li').on('click', function() {
                        let selected = $(this).text();
                        tab.push(selected);
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
