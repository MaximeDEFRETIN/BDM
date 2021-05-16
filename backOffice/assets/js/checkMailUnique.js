// On cache le message d'erreur
$('#errorCheckMailUnique').css('display', 'none');
// La fonction permet de vérifier que le  est unique
function checkMailUnique() {
    // On envoie les données, avec AJAX, directement au serveur
    $.post(
            // On inclus le controller de l'inscription pou vérifier ensuite si l'adresse mail entré est déjà dans la base de donnée ou non
            '../../controllers/addUser-Controller.php',
            {
                // On envoie au controller la valeur entrée dans le champs mail
                checkMail: $('#mail').val()
            },
            // On récupère les résultats du controller
            function (checkMailResult) {
                // Si on retrouve une addresse mail dans la base de donnée, alors on affiche un message d'erreur
                if (checkMailResult == 1) {
                    $('#errorCheckMailUnique').css('display', 'block');
                    $('#submitRegistrer').attr('disabled', 'disabled');
                // Sinon rien est affiché
                } else {
                    $('#errorCheckMailUnique').css('display', 'none');
                    $('#submitRegistrer').removeAttr('disabled', 'disabled');
                }
            },
            'JSON'
            )
};