$('#display').click(function() {
    console.log($('#id_answer').val());
    var data = "id_answer="+$('#id_answer').val();
    $.post(
            '../../controllers/answer-Controller.php',
            {
                data
            },
            console.log($('#id_answer').val()),
            function (answerResultP) {
                console.log($('#id_answer').val());
                var answerResultP = $.parseJSON(answerResult);
                $.each(answerResultP, function (index, value) {
                    $('#answerDisplay').append('<p>Essaie</p>');
                    console.log($('#id_answer').val());
                });
            },
            'JSON',
           );
});

console.log('LOLILOL Réponse aux commentaires');