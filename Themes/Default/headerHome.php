<?php
$pageCourrante = $_SERVER['PHP_SELF'];
var_dump($pageCourrante);
//function findPath($pageCourrante) {
    $tableauFichier = array_values(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/Themes/Default'), array('..', '.')));
    var_dump($tableauFichier);
//}
    
require_once ($_SERVER['PHP_SELF']=='/index.php')?'models/dataBase.php':'../../models/dataBase.php';
require_once ($_SERVER['PHP_SELF']=='/index.php')?'models/user.php':'../../models/user.php';
require_once ($_SERVER['PHP_SELF']=='/index.php')?'models/pages.php':'../../models/pages.php';
require_once ($_SERVER['PHP_SELF']=='/index.php')?'models/articles.php':'../../models/articles.php';
require_once ($_SERVER['PHP_SELF']=='/index.php')?'controllers/connection-Controller.php':'../../controllers/connection-Controller.php';
require_once ($_SERVER['PHP_SELF']=='/index.php')?'controllers/mailRecoveryPassword-Controller.php':'../../controllers/mailRecoveryPassword-Controller.php';
require_once ($_SERVER['PHP_SELF']=='/index.php')?'controllers/Home-Controller.php':'../../controllers/Home-Controller.php';
//
//var_dump($_SERVER['SCRIPT_FILENAME']);
//var_dump($_SERVER['PHP_SELF']);
//var_dump($_SERVER['DOCUMENT_ROOT']);
//var_dump($_SERVER['REQUEST_URI']);
//var_dump($_SERVER['PHP_SELF']=='/index.php');
//
//var_dump(array_values(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/Themes/Default'), array('..', '.'))));
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
