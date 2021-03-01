<?php
// On instancie un objet

// Si l'utilisateur veut modifier un article,
// on le récupère grâce à son id
if (isset($_GET['upEv'])) {
    if (filter_var($_GET['upEv'], FILTER_VALIDATE_INT)) {
        $changeEvent = new event_association();
        $changeEvent->id = $_GET['upEv'];
        $displayEvent = $changeEvent->getEventById();
    } else {
        header('Location: Profile');
    }
    
    $regexVar = '/^([A-Za-z0-9ÉÈÀÊÀÙÎÏÜËéèàêâùïüë\-_()\ ]){1,}(.pdf)$/';
    if (isset($_GET['path']) && !preg_match($regexVar, $_GET['path'])) {
        header('Location: Evennements');
    }
}

// On instancie un objet
$updateEvent = new event_association();
$insertSuccessUpdateEvent = false;
// On crée une variable contenant tous les messages destinés à l'utilisateur
$messageChangingEvent = array();
$regexUpEvent = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';

if (isset($_POST['submitUpdateEvent'])) {
    if (empty($_POST['updateEvent']) || empty($_POST['updateStatusEvent']) || empty($_POST['updateDate'])) {
        $messageChangingEvent['emptyFormChanging'] = 'Il y a un champ vide !';
    } else {
        if (!empty($_POST['updateEvent'])) {
            if (preg_match($regexUpEvent, $_POST['updateEvent'])) {
                $updateEvent->suggested_event = htmlspecialchars(strip_tags($_POST['updateEvent']));
            } else {
                $messageChangingEvent['suggestedEventWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageChangingEvent['noUpdateEvent'] = 'Aucun évènement n\'a été donné.';
        }

        if (!empty($_POST['updateStatusEvent'])) {
            $updateEvent->status_event = htmlspecialchars(strip_tags($_POST['updateStatusEvent']));
        } else {
            $messageChangingEvent['noUpdateStatus'] = 'Aucun status n\'a été donné.';
        }
        if (!empty($_POST['descriptionEvent'])) {
            if (preg_match($regexUpEvent, $_POST['descriptionEvent'])) {
                $updateEvent->description_event = htmlspecialchars(strip_tags($_POST['descriptionEvent']));
            } else {
                $messageChangingEvent['descriptionEventWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageChangingEvent['noUpdateEvent'] = 'Aucune tâche n\'a été donné.';
        }

        if (!empty($_POST['updateDate'])) {
            $updateEvent->date_event = htmlspecialchars(strip_tags($_POST['updateDate']));
        } else {
            $messageChangingEvent['noUpdateDate'] = 'Aucune date n\'a été donné.';
        }

        if (count($messageChangingEvent) === 0) {
            $updateEvent->id = $_GET['upEv'];
            if (!$updateEvent->updateEventById()) {
                $messageChangingEvent['noUpdateEvent'] = 'L\'article n\'a pas pu être mis à jour !';
            } else {
                $insertSuccessUpdateEvent = true;
                $messageChangingEvent['updateEvent'] = 'L\'article a été mis à jour !';
                
                header('refresh: 5; url=Evennements');
                
                $updateEvent->id = 0;
                $updateEvent->description_event = '';
                $updateEvent->status_event = '';
                $updateEvent->suggested_event = '';
                $updateEvent->date_event = '';
                $updateEvent->path_document_event = '';
            }
        }
    }
}


$updateFile = new event_association();
// On crée une variable contenant tous les messages destinés à l'utilisateur
$messageChangingFile = array();

$regexDeleFile = '/^(.)+(.pdf)$/';
if (isset($_POST['submitUpdateFile'])) {    
        // On vérifie que le fichier bien été envoyé et qu'il n'y a pas d'erreur
        if (!empty($_FILES['updateFileEvent']['name']) && $_FILES['updateFileEvent']['error'] == 0) {
            // Testons si le fichier n'est pas trop gros
            if ($_FILES['updateFileEvent']['size'] <= 5000000) {
                // On vérifie si le fichier est dans un des formats autorisés
                $fileType = pathinfo($_FILES['updateFileEvent']['name']);
                $extension_upload = $fileType['extension'];
                $extensions_autorisees = array('pdf');
                $contentType = $_FILES['updateFileEvent']['type'];
                $contentType_autorisees = array('application/pdf');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    if (in_array($contentType, $contentType_autorisees)) {
                        // On peut valider le fichier et le stocker définitivement
                        move_uploaded_file($_FILES['updateFileEvent']['tmp_name'], '../document/'.$_FILES['updateFileEvent']['name']);
                        chmod('../document/'.$_FILES['updateFileEvent']['name'], 0660);
                    }
                } else {
                    $messageChangingEvent['extensionFile'] = 'L\'extension du fichier n\'est pas autorisée.';
                }
            } else {
                $messageChangingEvent['sizeFile'] = 'Le fichier est trop lourd.';
            }
        } else {
            if (empty($_FILES['updateFileEvent']['name'])) {
                if (preg_match($regexDeleFile, $_GET['path'])) {
                        unlink('../document/'.$_GET['path']);

                        header('refresh: 5; url=Evennements');
                }
            }
        }
        
        if (count($messageChangingEvent) == 0) {
            // On appelle la méthode pour ajouter l'évènement
            $updateFile->updateFileEventById($_FILES['updateFileEvent']['name'], $_GET['upEv']);

            $messageChangingEvent['add'] = 'Le document est bien ajouté !';

            header('refresh:5; url=Evennements');
        }
}