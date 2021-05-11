<?php
$getTheme = new themes();
$useTheme = $getTheme->getThemeHome();
$arrayValueTheme = array('Nom' => $useTheme->nom, 'Auteur' => $useTheme->auteur, 'Version' => $useTheme->version, 'Date' => $useTheme->date, 'MAJ' => $useTheme->maj);