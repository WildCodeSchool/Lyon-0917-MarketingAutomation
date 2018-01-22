
var options = [
    {selector: '.class', offset: 200, callback: customCallbackFunc },
    {selector: '.other-class', offset: 200, callback: function() {
            customCallbackFunc();
        } },
];
Materialize.scrollFire(options);



{selector: '#image-test', offset: 500, callback: function(el) { Materialize.fadeInImage($(el)); } } ];
Materialize.scrollFire(options);