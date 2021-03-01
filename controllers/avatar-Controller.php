<?php
// On instancie un objet
$userAvatar = new avatar();

// On crée un tableau contenant tous les messages destiné aux utilisateurs
$messageAvatar = array();
// On vérifieque l'utiisateur clique sur le bouton newAvatar
if (isset($_POST['newAvatar'])) {
    // On vérifie que le fichier bien été envoyé et qu'il n'y a pas d'erreur
    if (!empty($_FILES['avatarFile']['name']) && $_FILES['avatarFile']['error'] == 0) {
            // On vérifie que e fichier ne dépasse pas une limite autorisée
            if ($_FILES['avatarFile']['size'] <= 5000000) {
                $userAvatar->id_agdjjg_user = $_SESSION['id'];
                
                // On récupère les infos sur le fichier
                $fileType = pathinfo($_FILES['avatarFile']['name']);
                $extension_upload = $fileType['extension'];
                // On vérifie que le fichier ait bien un format et un content type attendu
                $extensions_autorisees = array('png', 'jpg', 'jpeg');
                $contentType = $_FILES['avatarFile']['type'];
                $contentType_autorisees = array('image/png', 'image/jpg', 'image/jpeg');
                if (in_array($extension_upload, $extensions_autorisees)) {
                    if (in_array($contentType, $contentType_autorisees)) {
                        // On crée un dossier pour l'urtilisateur si il n'existe pas
                        if (!file_exists('backOffice/avatar/'.$_SESSION['id'])) {
                            mkdir('backOffice/avatar/'.$_SESSION['id'], 0760, true);
                        }
                        // On déplace le fichier
                        move_uploaded_file($_FILES['avatarFile']['tmp_name'], '../backOffice/avatar/'.$_SESSION['id'].'/'.$_FILES['avatarFile']['name']);
                        // On change ses droits
                        chmod('../backOffice/avatar/' . $_SESSION['id'].'/'.$_FILES['avatarFile']['name'], 0660);
                        // On récupère l'id de l'utilisateur pour l'associer au chemin du fichier et l'inséré dans la base de donnée
                        $userAvatar->id = $_SESSION['id'];
                        $userAvatar->path_avatar = '../backOffice/avatar/'.$_SESSION['id'].'/'.$_FILES['avatarFile']['name'];
                        $userAvatar->insertAvatar();
                        $messageAvatar['succes'] = 'Envoie effectué';
                        header('refresh:5; url=Modification-profile');
                    } else {
                        $messageAvatar['contentFile'] = 'Le contenu du fichier n\'est pas autorisée.';
                    }
                } else {
                    $messageAvatar['extensionFile'] = 'L\'extension du fichier n\'est pas autorisée.';
                }
            } else {
                $messageAvatar['sizeFile'] = 'Le fichier est trop lourd.';
            }
    } else {
        $messageAvatar['emptyFile'] = 'Il faut envoyer un avatar au format PNG, JPG ou JPEG.';
    }
}


// On crée un objet
$deleteAvatar = new avatar();

// Si on clique sur le boutton
if (isset($_POST['deleteAvatar'])) {
    // On récupère l'id de la session à id
    $deleteAvatar->id = $_SESSION['id'];
    
    // Si la méthode est bien exécutée
    if ($deleteAvatar->deleteAvatarById()) {
        // On applique la suppresion de fichier à tous les fichier ayant le format PNG dans
        // le dossier avatar/' . $_SESSION['id']
        // glob() recherche des chemins ayant le même pattern. aray_map() exécute une fonction
        // un élément entré en 2ème patramètre
        array_map('unlink', glob('../backOffice/avatar/'.$_SESSION['id'].'/*.*'));
        // On rédirige l'utilisateur vers la page principale
        header('Location: Modification-profile');
        // On met fin au script
        exit;
    }
}