<?php
$messageUpPage = array();

if (isset($_POST['submitUpDescription'])) {
    if (isset($_GET['upRea'])) {
        if (filter_var($_GET['upRea'], FILTER_VALIDATE_INT)) {
            $updateReaded = new pages();
            $updateReaded->id = $_GET['upRea'];
            $updateReaded->title = $_POST['upTitle'];
            $updateReaded->opinion_book = $_POST['upDescriptionBook'];

            $updateReaded->updatePage();

            // On affiche un message à l'utilisateur
            $messageUpPage['updateReaded'] = 'La description est modifiée !';
            // On recharge la page au bout de 5 secondes
            header('refresh:5; url=Pages');
        } else {
            header('Location: Pages');
        }
    }
}

if (isset($_GET['upRea'])) {
    if (filter_var($_GET['upRea'], FILTER_VALIDATE_INT)) {
        $getPage = new pages();
        $getPage->id= $_GET['upRea'];
        $displayGetPage = $getPage->getPageById();
    }
}