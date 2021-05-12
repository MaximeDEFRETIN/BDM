<?php
require_once 'models/dataBase.php';
require_once 'models/themes.php';

$getTheme = new themes();

$useTheme = $getTheme->getThemeHome();
$_SERVER['Themes'] = array('Prefixe' => ($_SERVER['PHP_SELF'] == '/index.php')?'':'../../', 'Nom' => $useTheme->nom, 'Auteur' => $useTheme->auteur, 'Version' => $useTheme->version, 'Date' => $useTheme->date, 'MAJ' => $useTheme->maj);
var_dump($_SERVER['Themes']);