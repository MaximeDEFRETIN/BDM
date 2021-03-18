<?php
// include_once permet d'inclure les models et les contrôleurs si ils n'ont pas déjà été inclus
// On inclus les models
require_once '../../models/dataBase.php';
require_once '../../models/user.php';
require_once '../../models/pages.php';
require_once '../../models/articles.php';
require_once '../../models/comment_article.php';
require_once '../../controllers/connection-Controller.php';
require_once '../../controllers/mailRecoveryPassword-Controller.php';
require_once '../../controllers/Home-Controller.php';
require_once '../../controllers/commentArticle-Controller.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="Site de l'association Bibliothèque des Malades" />
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="bower_components/materialize/dist/css/materialize.css" type="text/css" />
        <script src="bower_components/jQuery/dist/jquery.min.js" type="text/javascript"></script>
        <script src="assets/js/script.js" type="text/javascript"></script>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <title>Bibliothèque des Malades</title>
    </head>
    <body class="row lime lighten-5">
