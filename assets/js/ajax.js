$('#submitConnection').click(function () {
    event.preventDefault();
    $.post(
        'controllers/connection-Controller.php',
        {
            mailConnection: $('#mailConnection').val(),
            passwordConnection: $('#passwordConnection').val()
        },
        'document'
    )
    .done(function(data, response) {
        alert("OUAIS !!!");
        $('#Essaie').append('<p>Connecté</p>');
        var obj = jQuery.parseJSON(data);
        console.log(obj);
        $('#submitConnection').after('<p>'+data+'</p><p>'+response+'</p>');
//        $.delay(20000);
        $(location).attr("href", "http://bdm/Profile");
    })
    .fail(function(request, data, response, error, status) {
        alert("LOLILOL");
        console.log(data);
        console.log(response);
        console.log(request);
        console.log(arguments);
        console.log(status);
        console.log(error);
        $('#Essaie').append('<p>'+data+'</p><p>'+response+'</p>');
    });
});