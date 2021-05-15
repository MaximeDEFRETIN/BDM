<?php
// On instancie un objet
$insertComment = new comment_article();
$messageComment = array();
// Les regex servent à s'assurer que les informations rentrées par l'utilisateurs sont bien celle attendues
$regexAuthor = '/^[A-ZÉÈÀÊÀÙÎÏÜË]{1}[a-zéèàêâùïüë]+[-]{0,}[A-ZÉÈÀÊÀÙÎÏÜË]{0,1}[a-zéèàêâùïüë]{0,}/';
$regexComment = '/[[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';

if (isset($_POST['submitComment'])) {
    if(empty($_POST['authorComment']) && empty($_POST['comment'])){
        $messageComment['emptyFormComment'] = 'Il faut remplir entièrement le formulaire pour publier un commentaire.';
    } else {
    // On vérifie que l'utilisateur rentre des informations et qu'elles soient celle attendues
    if (!empty($_POST['authorComment'])) {
        if (preg_match($regexAuthor, $_POST['authorComment'])) {
            $insertComment->author = htmlspecialchars(strip_tags($_POST['authorComment']));
        } else {
            $messageComment['authorWrong'] = 'Le nom n\'est pas correcte !';
        }
    } else {
        $messageComment['emptyAuthor'] = 'Tu n\'as pas donné ton prénom.';
    }
    if (!empty($_POST['comment'])) {
        if (preg_match($regexComment, $_POST['comment'])) {
            $insertComment->comment_article = htmlspecialchars(strip_tags($_POST['comment']));
        } else {
            $messageComment['commentWrong'] = 'Le commentaire n\'est pas correcte !';
        }
    } else {
        $messageComment['emptyComment'] = 'Tu n\'as pas donné ton avis.';
    }
    
    $insertComment->id_agdjjg_actuality = $_GET['art'];
    $insertComment->id_answer_comment = NULL;
    
    // Si $insertComment ne correspond pas au model, alors on envoie un message d'erreur
    if (count($messageComment) == 0) {
        // On appelle la méthode
        $insertComment->insertComment();
        
        $insertComment->comment_article = '';
        $insertComment->author = '';
        $insertComment->id_agdjjg_actuality ='';
        
        $messageComment['add'] = 'Le commentaire a été ajouté !';
        }
    }
}

// On instancie un objet
$answerComment = new comment_article();
// On crée un tableau pour afficher un message destiné à l'utilisateur
$messageAnswer = array();

if (isset($_POST['submitAnswer'])) {
    if(empty($_POST['authorAnswer']) && empty($_POST['answer'])){
        $messageAnswer['emptyFormComment'] = 'Il faut remplir entièrement le formulaire pour publier un commentaire.';
    } else {
    // On vérifie que l'utilisateur rentre des informations et qu'elles soient celle attendues
    if (!empty($_POST['authorAnswer'])) {
        if (preg_match($regexAuthor, $_POST['authorAnswer'])) {
            $answerComment->author = htmlspecialchars(strip_tags($_POST['authorAnswer']));
        } else {
            $messageAnswer['authorWrong'] = 'Le nom n\'est pas correcte !';
        }
    } else {
        $messageAnswer['emptyAuthor'] = 'Tu n\'as pas donné ton prénom.';
    }
    if (!empty($_POST['answer'])) {
        if (preg_match($regexComment, $_POST['answer'])) {
            $answerComment->comment_article = htmlspecialchars(strip_tags($_POST['answer']));
        } else {
            $messageAnswer['commentWrong'] = 'Le commentaire n\'est pas correcte !';
        }
    } else {
        $messageAnswer['emptyComment'] = 'Tu n\'as pas donné ton avis.';
    }
    
    if (filter_var($_POST['id_answer_comment'], FILTER_VALIDATE_INT)) {
        $answerComment->id_answer_comment = $_POST['id_answer_comment'];
    } else {
        $messageAnswer['id_comment'] = 'Tu as cherché à modifier une valeur. Évite ça.';
    }
    
    $answerComment->id_agdjjg_actuality = $_GET['art'];
    // Si $insertComment ne correspond pas au model, alors on envoie un message d'erreur
    if (count($messageAnswer) == 0) {
        // On appelle la méthode
        $answerComment->insertComment();
        
        $answerComment->comment_article = '';
        $answerComment->author = '';
        $answerComment->id_agdjjg_actuality = 0;
        $answerComment->id_answer_comment = NULL;
        
        $messageAnswer['add'] = 'Le commentaire a été ajouté !';
        }
    }
}

// On instancie un objet
$displayComment = new comment_article();

// On récupère chaque article en fonction de leur id, pour les afficher
//if (isset($_GET['art'])) {
//    if (filter_var($_GET['art'], FILTER_VALIDATE_INT)) {
////        $displayComment->id_agdjjg_actuality = $_GET['art'];
//        $commentsList = $displayComment->getCommentArticleById(1, $_GET['art']);
//    } else {
//        header('Location: Profile');
//    }
//}
(isset($_GET['art']))?(filter_var($_GET['art'], FILTER_VALIDATE_INT))?$commentsList = $displayComment->getCommentArticleById(1, $_GET['art']):header('Location: Profile'):'';