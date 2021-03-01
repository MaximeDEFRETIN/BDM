<?php
$getTask = new task();
$displayTask = $getTask->getTask();

// On crée un tableau qui permettra d'afficher des messages pour l'utilisateur
$messageTask = array();

if (isset($_GET['idTas'])) {
    if (filter_var($_GET['idTas'], FILTER_VALIDATE_INT)) {
        // On instancie un nouveau objet
        $deleteVolunteer = new task();

        // On attribut des valeurs
        $deleteVolunteer->id = $_SESSION['id'];
        $deleteVolunteer->id_agdjjg_task = $_GET['idTas'];
        $deleteVolunteer->deleteVolunteerById();

        // On affiche un message pour l'utilisateur
        $messageTask['deleteVolunteer'] = 'Tu n\'es plus dans la liste !';

        header('refresh:5; url=../Taches');
    } else {
        header('Location: Taches');
    }
}

// On crée un objet $task
$task = new task();
$regexTask = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';

// Lorsque l'on clique sur submitTask et qu'il n'y a aucune erreur, le formulaire es validé
if (isset($_POST['submitTask'])) {
    if(empty($_POST['suggestedTask']) && empty($_POST['descriptionTask'])){
        $messageTask['emptyFormTask'] = 'Il faut remplir entièrement le formulaire ajouter une tâche.';
    } else {
    // On vérifie que les informations entrées dans le formulaire correspondent à celles qui sont attendues
    if (!empty($_POST['suggestedTask'])) {
        if (preg_match($regexTask, $_POST['suggestedTask'])) {
            $task->suggested_task = htmlspecialchars(strip_tags($_POST['suggestedTask']));
        } else {
            $messageTask['suggestedWrong'] = 'Le titre n\'est pas correcte !';
        }
    } else {
        $messageTask['emptySuggestedTask'] = 'Le nom n\'est pas donné.';
    }
    if (!empty($_POST['descriptionTask'])) {
        if (preg_match($regexTask, $_POST['descriptionTask'])) {
            $task->description_task = htmlspecialchars(strip_tags($_POST['descriptionTask']));
        } else {
            $messageTask['descriptionWrong'] = 'Le titre n\'est pas correcte !';
        }
    } else {
        $messageTask['emptyDescriptionTask'] = 'La description n\'est pas donnée.';
    }
    
    $task->id_agdjjg_user = $_SESSION['id'];

    // Si $task ne correspond pas au model, alors on envoie un message d'erreur
    if (count($messageTask) == 0) {
        // On appelle la méthode
        $task->addTask();

        $task->suggested_task = '';
        $task->description_task = '';
        $task->id_agdjjg_user = 0;
        
        $messageTask['add'] = 'La tâche a été ajoutée !';
        
        header('refresh:5; url=Taches');
        }
    }
}

if (isset($_GET['upStatus'])) {
    if (filter_var($_GET['upStatus'], FILTER_VALIDATE_INT)) {
        // On crée un objet $task
        $updateStatusTask = new task();
        // On récupère l'id de la tâche en GET
        $updateStatusTask->id = $_GET['upStatus'];
        // On attribue un statut
        $updateStatusTask->status_task = 'Terminee';
        // Et on change le statut de la tâche
        $updateStatusTask->updateStatusTaskById();

        // On affiche un message à l'utilisateur
        $messageTask['updateStatus'] = 'La tâche est bien terminée !';
        // On recharge la page au bout de 5 secondes
        header('refresh:5; url=Taches');
    } else {
        header('Location: Taches');
    }
}

if (isset($_GET['delTas'])) {
    if (filter_var($_GET['delTas'], FILTER_VALIDATE_INT)) {
        // On crée un objet $task
        $delTask = new task();
        $delTask->id = $_GET['delTas'];
        // On supprime la tâche
        $delTask->deleteTaskById();

        header('Location: ../Taches');
    }
}

if (isset($_GET['addVo'])) {
    // On vérifie que $_GET['addVo'] soit bien un entier
    if (filter_var($_GET['addVo'], FILTER_VALIDATE_INT)) {
        // On instancie un objet $volunteer
        $volunteer = new task();
        $volunteer->id_task = strip_tags($_GET['addVo']);
        $volunteer->volunteer = $_SESSION['first_name'].' '.$_SESSION['last_name'];
        $volunteer->id = $_SESSION['id'];
        $volunteer->assignVolunteer();

        $volunteer->id = strip_tags($_GET['addVo']);
        $volunteer->status_task = 'En cours';
        $volunteer->updateStatusTaskById();

        // On affiche un message pour l'utilisateur
        $messageTask['addVolunteer'] = 'Tu as bien été ajouté.';

        // On recharge la page
        header('refresh:5; url=Taches');
    } else {
        header('Location: Taches');
    }
}

$assignedVolunter = new task();
$displayAssignedVolunter = $assignedVolunter->getAssignedVolunteer();