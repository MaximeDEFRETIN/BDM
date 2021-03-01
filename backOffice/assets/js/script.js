$(document).ready(function () {
    $('.modal').modal();
    $('#article, #titleArticle, #last_name, #mail, #first_name, #suggestedTask, #task, #suggestedEvent, #descriptionEvent,  #last_nameUpdate, #mailUpdate, #first_nameUpdate, #passwordUpdate, #mailNewUser, #passwordNewUser, #updateText, #updateTitle, #updateDate, #updateDescriptionEvent, #updateEvent').characterCounter();
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: 15,
        today: 'Aujourd\'hui',
        clear: 'Réinitialiser',
        close: 'Ok',
        closeOnSelect: false,
        container: undefined,
        format: 'dd/mm/yyyy',
  });
  $('select').material_select();
});