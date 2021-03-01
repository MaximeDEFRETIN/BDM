$(document).ready(function () {
    $('.modal').modal();
    $('#passwordUpdate, #mailNewUser, #passwordNewUser, #authorComment, #comment').characterCounter();

  $('select').material_select();
  
    $('#displayInputFileEvent').hide();
    $('#addDocumentEvent').click(function () {
        $('#displayInputFileEvent').show();
    });
    
    $('.buttonAnswer').click(function () {
        $('.answerForm').show();
    });
    $('.buttonAnswer').dblclick(function () {
        $('.answerForm').hide();
    });
    $('[answer]').hide();
});

    function displayAnswer(id) {
        var essaie = $('[answer="'+id+'"]').get();
        $('a[id="'+id+'"]').after(essaie);
        $(essaie).attr('margin-left', '10%');
        $(essaie).show();
    };

    function formAnswer(id) {
        $('a[id="'+id+'"]').after('<form method="POST" class="center-align" id="form'+id+'"><input type="number" name="id_answer_comment" value="'+id+'" hidden /><div class="marginTop col s12 input-field"><input type="text" id="authorAnswer" name="authorAnswer" /><label for="authorAnswer" class="black-text">Ton prénom</label></div><div class="marginTop col s12 input-field"><input type="text" id="answer" name="answer" /><label for="answer" class="black-text">Ta réponse</label></div><input type="submit" class="btn center-align" name="submitAnswer" value="Répondre" /></form>');
        $('a[id="'+id+'"]').attr('disabled', 'disabled');
    };