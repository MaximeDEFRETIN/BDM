<?php
// On instancie un objet
$changeTask = new task();

// Si l'utilisateur veut modifier un article,
// on le récupère grâce à son id
if (isset($_GET['upTas'])) {
    if (filter_var($_GET['upTas'], FILTER_VALIDATE_INT)) {
        $changeTask->id = $_GET['upTas'];
        $displayTask = $changeTask->getTaskById();
    } else {
        header('Location: Profile');
    }
}

// On instancie un objet
$updateTask = new task();
$insertSuccessUpdateTask = false;
// On crée une variable contenant tous les messages destinés à l'utilisateur
$messageChangingTask = array();
// La regex oblige l'utilisateur à ne rentrer que les informations attendues
$regexUpTask = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';

if (isset($_POST['submitUpdateTask'])) {
    if (empty($_POST['updateTask']) || empty($_POST['updateDescription'])) {
        $messageChangingTask['emptyFormChanging'] = 'Il y a un champ vide !';
    } else {
        if (!empty($_POST['updateTask'])) {
            if (preg_match($regexUpTask, $_POST['updateTask'])) {
                $updateTask->suggested_task = htmlspecialchars(strip_tags($_POST['updateTask']));
            } else {
                $messageChangingTask['suggestedWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageChangingTask['noUpdateTask'] = 'Aucune tâche n\'a été donné.';
        }

        if (!empty($_POST['updateDescription'])) {
            if (preg_match($regexUpTask, $_POST['updateDescription'])) {
                $updateTask->description_task = htmlspecialchars(strip_tags($_POST['updateDescription']));
            } else {
                $messageChangingTask['descriptionWrong'] = 'La dsecription n\'est pas correcte !';
            }
        } else {
            $messageChangingTask['noUpdateDescription'] = 'Aucune description n\'a été donné.';
        }

        if (count($messageChangingTask) === 0) {
            $updateTask->id = $_GET['upTas'];
            if (!$updateTask->updateTaskById()) {
                $messageChangingTask['noUpdateTask'] = 'L\'article n\'a pas pu être mis à jour !';
            } else {
                $insertSuccessUpdateTask = true;
                $messageChangingTask['updateTask'] = 'L\'article a été mis à jour !';
                
                $updateTask->id = 0;
                $updateTask->suggested_task = '';
                $updateTask->description_task = '';
            }
        }
    }
}
?>