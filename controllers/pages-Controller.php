<?php
$messagePage = array();

// Lorsque l'on clique sur submitTask et qu'il n'y a aucune erreur, le formulaire es validé
if (isset($_POST['submitDescription'])) {
    if(empty($_POST['title']) && empty($_POST['descriptionBook'])){
        $messagePage['emptyFormReaded'] = 'Il faut remplir entièrement le formulaire.';
    } else {
        $readed = new pages();
        $regexPages = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';
        if (!empty($_POST['title'])) {
            if (preg_match($regexPages, $_POST['title'])) {
                $readed->title = htmlspecialchars(strip_tags($_POST['title']));
            } else {
                $messagePage['titleWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messagePage['emptyTitle'] = 'Le titre n\'est pas donné.';
        }
        if (!empty($_POST['descriptionBook'])) {
            if (preg_match($regexPages, $_POST['descriptionBook'])) {
                $readed->texte_page = htmlspecialchars(strip_tags($_POST['descriptionBook']));
            } else {
                $messagePage['descriptionWrong'] = 'La description n\'est pas correcte !';
            }
        } else {
            $messagePage['emptyDescriptionReaded'] = 'La description n\'est pas donnée.';
        }

        $readed->mail= $_SESSION['mail'];

        // Si $readed ne correspond pas au model, alors on envoie un message d'erreur
        if (count($messagePage) == 0) {
            // On appelle la méthode
            $readed->addPage();

            $readed->title = '';
            $readed->texte_page = '';
            $readed->mail= '';

            $messagePage['add'] = 'La description du livre a été ajouté !';

            header('refresh:5; url=Pages');
        }
    }
}

$countReadedBook = new pages();
$count = $countReadedBook->countPages();
$pagesBook = ceil($count->id_count / 3);

$getReadedBook = new pages();

if (!isset($_GET['paRea']) || $_GET['paRea'] < 0) {
    $displayReadedBook = $getReadedBook->getPages(0);
} else if (isset($_GET['paRea'])) {
    if (filter_var($_GET['paRea'], FILTER_VALIDATE_INT)) {
        $displayReadedBook = $getReadedBook->getPages($_GET['paRea']);
    } else {
        header('Location: Pages');
    }
}

if (isset($_GET['delRea'])) {
    if (filter_var($_GET['delRea'], FILTER_VALIDATE_INT)) {
            $delReaded = new pages();
            $delReaded->id = $_GET['delRea'];
            $delReaded->deletePageById();

            header('Location: ../Pages');
    } else {
        header('Location: ../Pages');
    }
}