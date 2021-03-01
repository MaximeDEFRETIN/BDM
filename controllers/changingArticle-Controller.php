<?php

if (isset($_GET['chanArt'])) {
    if (filter_var($_GET['chanArt'], FILTER_VALIDATE_INT)) {
        $changeArticle = new actuality();
        $changeArticle->id = $_GET['chanArt'];
        $displayActuality = $changeArticle->getArticleById();
    } else {
        header('Location: Articles');
    }
}

$insertSuccessUpdateArticle = false;
$messageChangingActuality = array();
$regexUpdate = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';

if (isset($_POST['submitUpdateArticle'])) {
    $updateArticle = new actuality();
    if (empty($_POST['updateTitle']) || empty($_POST['updateText'])) {
        $messageChangingActuality['emptyFormChanging'] = 'Il y a un champ vide !';
    } else {
        if (!empty($_POST['updateTitle'])) {
            if (preg_match($regexUpdate, $_POST['updateTitle'])) {
                $updateArticle->title = htmlspecialchars(strip_tags($_POST['updateTitle']));
            } else {
                $messageChangingActuality['titleUpWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageChangingActuality['noUpdateTitle'] = 'Aucun titre n\'a été donné.';
        }

        if (!empty($_POST['updateText'])) {
            if (preg_match($regexUpdate, $_POST['updateText'])) {
                $updateArticle->article = htmlspecialchars(strip_tags($_POST['updateText']));
            } else {
                $messageChangingActuality['articleUpWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageChangingActuality['noUpdateText'] = 'Aucun texte n\'a été donné.';
        }

        if (count($messageChangingActuality) === 0) {
            $updateArticle->id = $_GET['chanArt'];
            if (!$updateArticle->updateArticleById()) {
                $messageChangingActuality['noUpdateArticle'] = 'L\'article n\'a pas pu être mis à jour !';
            } else {
                $insertSuccessUpdateArticle = true;
                $messageChangingActuality['updateArticle'] = 'L\article a été mis à jour !';
                
                $updateArticle->id = 0;
                $updateArticle->title = '';
                $updateArticle->article = '';
            }
        }
    }
}