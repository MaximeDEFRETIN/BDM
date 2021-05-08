<?php
function findPath($pageCourrante) {
    $tableauFichier = [array_values(array_diff(scandir($_SERVER['DOCUMENT_ROOT'].'/Themes/Default'), array('..', '.')))];
    (array_search($tableauFichier, $pageCourrante))?$path2:'';
}