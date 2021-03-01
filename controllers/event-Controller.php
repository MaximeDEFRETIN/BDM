<?php
$messageEvent = array();

if (isset($_POST['submitEvent'])) {
    if(empty($_POST['descriptionEvent']) && empty($_POST['suggestedEvent']) && empty($_POST['statusEvent']) && empty($_POST['dateEvent'])){
            $messageEvent['emptyFormEvent'] = 'Il faut remplir entièrement le formulaire pour ajouter un évènnement.';
    } else {
        $event = new event_association();
        $regexEvent = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';
        if (!empty($_POST['descriptionEvent'])) {
            if (preg_match($regexEvent, $_POST['descriptionEvent'])) {
                $event->description_event = htmlspecialchars(strip_tags($_POST['descriptionEvent']));
            } else {
                $messageEvent['descriptionWrong'] = 'La description n\'est pas correcte !';
            }
        } else {
            $messageEvent['emptyDescriptionEvent'] = 'Tu n\'as pas décrit l\'évènnement.';
        }
        if (!empty($_POST['suggestedEvent'])) {
            if (preg_match($regexEvent, $_POST['suggestedEvent'])) {
                $event->suggested_event = htmlspecialchars(strip_tags($_POST['suggestedEvent']));
            } else {
                $messageEvent['titleWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageEvent['noStatusEvent'] = 'Tu n\as pas donné de nom à l\'évènnement.';
        }
        if (!empty($_POST['statusEvent'])) {
            if ($_POST['statusEvent'] === 'Formation' || 'Réunion' || 'Entre bénévole' || 'Sortie' || 'Autres' ) {
                $event->status_event = htmlspecialchars(strip_tags($_POST['statusEvent']));
            }
        } else {
            $messageEvent['noStatusEvent'] = 'Le statut de l\'évènnement  n\'est pas donnée.';
        }
        if (!empty($_POST['dateEvent'])) {
            $event->date_event = $_POST['dateEvent'];
        } else {
            $messageEvent['noDateEvent'] = 'La date de l\'évènnement  n\'est pas donnée.';
        }
        
        if (!empty($_FILES['documentFileEvent']['name']) && $_FILES['documentFileEvent']['error'] == 0) {
            if ($_FILES['documentFileEvent']['size'] <= 5000000) {
                $fileType = pathinfo($_FILES['documentFileEvent']['name']);
                $extension_upload = $fileType['extension'];
                $extensions_autorisees = array('pdf');
                $contentType = $_FILES['documentFileEvent']['type'];
                $contentType_autorisees = array('application/pdf');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    if (in_array($contentType, $contentType_autorisees)) {
                        move_uploaded_file($_FILES['documentFileEvent']['tmp_name'], '../document/'.$_FILES['documentFileEvent']['name']);
                        chmod('../document/'.$_FILES['documentFileEvent']['name'], 0760);
                        $event->path_document_event = $_FILES['documentFileEvent']['name'];
                    } else {
                        $messageEvent['contentFile'] = 'Le contenu du fichier n\'est pas autorisée.';
                    }
                } else {
                    $messageEvent['extensionFile'] = 'L\'extension du fichier n\'est pas autorisée.';
                }
            } else {
                $messageEvent['sizeFile'] = 'Le fichier est trop lourd.';
            }
        }

        $event->id_agdjjg_user = $_SESSION['id'];
        
        if (count($messageEvent) == 0) {
            $event->insertEventAssociation();

            $event->description_event = '';
            $event->suggested_event = '';
            $event->status_event = '';
            $event->author_event = '';
            $event->id_agdjjg_user = '';
            $event->id_agdjjg_status_event = '';
            $event->path_document_event = '';

            $messageEvent['add'] = 'L\'évènement est bien ajouté !';

            header('refresh:5; url=Evennements');
        }
    }
}



$getEvent = new event_association();
$displayEvent = $getEvent->getEvent();

if (isset($_GET['addPar'])) {
    if (filter_var($_GET['addPar'], FILTER_VALIDATE_INT)) {
        $addVolunteerEvent = new event_association();
        $addVolunteerEvent->id = $_SESSION['id'];
        $addVolunteerEvent->id_agdjjg_event_association = $_GET['addPar'];
        $addVolunteerEvent->volunteer_present =  $_SESSION['last_name'].' '.$_SESSION['first_name'];
        $addVolunteerEvent->addVolunteerEvent();

        $messageEvent['addVolunteerEvent'] = 'Ta participation as bien été enregistré !';
        header('refresh:5; url=Evennements');
    } else {
        header('Location: Evennements');
    }
}

$getVolunteerEvent = new event_association();
$displayVolunteerEvent = $getVolunteerEvent->getVolunteerEvent();


if (isset($_GET['idEvent'])) {
    if (filter_var($_GET['idEvent'], FILTER_VALIDATE_INT)) {
        $deleteVolunteerEvent = new event_association();

        $deleteVolunteerEvent->id = $_SESSION['id'];
        $deleteVolunteerEvent->id_agdjjg_event_association = $_GET['idEvent'];
        $deleteVolunteerEvent->deleteVolunteerEventById();
        $messageEvent['deleteVolunteer'] = 'Tu n\'es plus dans la liste !';

        header('refresh:5; url=Evennements');
    } else {
        header('Location: Evennements');
    }
}

if (isset($_GET['delEv'])) {
    if (filter_var($_GET['delEv'], FILTER_VALIDATE_INT)) {
        $deleteEvent = new event_association();
        $deleteEvent->id = $_GET['delEv'];

        $deleteEvent->deleteEventAssociation();
        (isset($_GET['path']))?unlink('../document/'.$_GET['path']):'';
        
        header('Location: ../Evennements');
    }
}