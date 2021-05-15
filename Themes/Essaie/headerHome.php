<?php
$prefixe=($_SERVER['PHP_SELF']!='/index.php')?'../../':'';
require_once $prefixe.'models/user.php';
require_once $prefixe.'models/pages.php';
require_once $prefixe.'models/articles.php';
require_once $prefixe.'controllers/connection-Controller.php';
require_once $prefixe.'controllers/mailRecoveryPassword-Controller.php';
require_once $prefixe.'controllers/Home-Controller.php';

var_dump($_SERVER['SCRIPT_FILENAME']);
var_dump($_SERVER['PHP_SELF']);
var_dump($_SERVER['DOCUMENT_ROOT']);
var_dump($_SERVER['REQUEST_URI']);
var_dump($_SERVER['PHP_SELF']=='/index.php');
var_dump($_SERVER['SCRIPT_FILENAME']);
var_dump($_SERVER['PHP_SELF']);
var_dump($_SERVER['DOCUMENT_ROOT']);
var_dump($_SERVER['REQUEST_URI']);
//var_dump($_SERVER['PHP_SELF']=='/index.php');

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
