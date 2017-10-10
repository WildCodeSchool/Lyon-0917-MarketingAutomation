$(document).ready(function () {
    $(".button-collapse").sideNav();

    $('input.autocomplete').autocomplete({
        data: {
            "Mailchimp": null,
            "Mautic": null,
            "IDcontact": null,
            "Actito": null

        },
        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function (val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });
});