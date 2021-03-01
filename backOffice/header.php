<?php
// Permet de démarrer une session
session_start();

// On définit la durée d'une session en seconde, la session dure 24 minutes
$timeout_duration = 1430;

// Si il y a bien une activité et qu'il n'y a pas eu de requête avant l'expiration de la session,
// alors on redirige l'utilisateur vers la page d'accueil
if (isset($_SESSION['LAST_ACTIVITY']) && ($_SERVER['REQUEST_TIME'] - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header('Location: /');
}

// On réactualise le timestamp de la dernière requête de l'utilisateur
$_SESSION['LAST_ACTIVITY'] = $_SERVER['REQUEST_TIME'];

// include_once permet d'inclure les models et les contrôleurs si ils n'ont pas déjà été inclus
// On inclus les models et les contrôleurs
require_once '../models/dataBase.php';
require_once '../models/user.php';
require_once '../models/avatar.php';
require_once '../models/task.php';
require_once '../models/articles.php';
require_once '../models/event_association.php';
require_once '../models/comment_article.php';
require_once '../models/pages.php';
require_once '../controllers/displayedAvatar-Controller.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="../bower_components/materialize/dist/css/materialize.css" type="text/css" />
        <script src="../bower_components/jQuery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="../backOffice/assets/js/checkMailUnique.js" type="text/javascript"></script>
        <script src="../backOffice/assets/js/script.js" type="text/javascript"></script>
        <link rel="stylesheet" href="assets/css/style.css" />
        <title>Bibliothèque des Malades</title>
    </head>
    <body class="row">
        <header>
            <nav role = "navigation" class="valign-wrapper">
                <div class="col s2 valign-wrapper">
                    <img src="<?= (isset($avatarDisplayed->path_avatar)?$avatarDisplayed->path_avatar:"assets/img/imgDefaultSmall.png") ?>"  height="50" width="50" class="circle responsive-img" id="avatarHeader" title="Avatar" alt="Avatar de <?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>" />
                    <p><?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></p>
                </div>
                <p class="col s2 offset-s4 center-align" title="Profile"><a href="Profile">Profile</a></p>
                <p class="col s2 center-align" title="Modification du profil"><a href="Modification-profile">Modifier ton profil</a></p>
                <p class="col s2 center-align" title="Déconnexion"><a href="controllers/deconnection-Controller.php">Déconnexion</a></p>
            </nav>
        </header>