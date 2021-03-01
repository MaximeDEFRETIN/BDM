<?php
// On instancie un objet
$avatarProfile = new avatar();

// Si il y a une session, on affiche l'avtar en fonction de l'id de l'utilisateur
if ($_SESSION['id']) {
    $avatarProfile->id_agdjjg_user = $_SESSION['id'];
    $avatarDisplayed = $avatarProfile->getAvatarById();
}
?>