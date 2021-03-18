$('#submitConnection').click(function () {
    event.preventDefault();
    $.post(
        'controllers/connection-Controller.php',
        {
            mailConnection: $('#mailConnection').val(),
            passwordConnection: $('#passwordConnection').val()
        },
        'json'
    )
    .done(function(data, response) {
        alert("OUAIS !!!");
        console.log(data);
        console.log(response);
        console.log($('#mailConnection').val());
        console.log($('#passwordConnection').val());
        $('#Essaie').append('<p>Connecté</p>');
        $('#Essaie').append('<p>'+data+'</p>');
        $('#Essaie').append('<p>'+response+'</p>');
//        $.delay(20000);
        $(location).attr("href", "http://bdm/Profile");
    })
    .fail(function(request, data, response, error, status) {
        console.log("LOLILOL");
        console.log(data);
        console.log(response);
        console.log(request);
        console.log(arguments);
        console.log(status);
        console.log(error);
        console.log($('#mailConnection').val());
        console.log($('#passwordConnection').val());
        $('#Essaie').append('<p>'+data+'</p>');
        $('#Essaie').append('<p>'+response+'</p>');
    });
});