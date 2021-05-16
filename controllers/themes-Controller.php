<?php
$getTheme = new themes();

$useTheme = $getTheme->getThemeHome();
$_SERVER['Themes'] = array('Nom' => $useTheme->nom, 'Auteur' => $useTheme->auteur, 'Version' => $useTheme->version, 'Date' => $useTheme->date, 'MAJ' => $useTheme->maj, 'Chemin' => '/Theme/'.$useTheme->nom.'/');
//var_dump($_SERVER);