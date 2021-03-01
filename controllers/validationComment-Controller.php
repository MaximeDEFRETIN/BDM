<?php
if (isset($_GET['va'])) {
    if (filter_var($_GET['va'], FILTER_VALIDATE_INT)) {
        $validationComment = new comment_article();
        $validationComment->id_agdjjg_actuality = $_GET['va'];
        
        $commentValided = $validationComment->getCommentArticleById(1);
        $commentNoValided = $validationComment->getCommentArticleById(0);
    }
}

if (isset($_GET['valCom']) && isset($_GET['va'])) {
    if (filter_var($_GET['valCom'], FILTER_VALIDATE_INT)) {
        if (filter_var($_GET['va'], FILTER_VALIDATE_INT)) {
            $validated = new comment_article();
            $validated->id = $_GET['valCom'];
            $validated->id_agdjjg_actuality = $_GET['va'];
            // On fait appel à la méthode
            $validated->validationComment(0);
            header('Location: ../Moderation-commentaire'.$_GET['va']);
        }
    }
}

if (isset($_GET['uVaCom']) && isset($_GET['va'])) {
    if (filter_var($_GET['uVaCom'], FILTER_VALIDATE_INT)) {
        if (filter_var($_GET['va'], FILTER_VALIDATE_INT)) {
            $unValidated = new comment_article();
            $unValidated->id = $_GET['uVaCom'];
            $unValidated->id_agdjjg_actuality = $_GET['va'];
            $unValidated->id_agdjjg_user = $_SESSION['id'];

            $unValidated->validationComment(1);
            header('Location: ../Moderation-commentaire'.$_GET['va']);
        }
    }
}

if (isset($_GET['delCo']) && isset($_GET['va'])) {
    if (filter_var($_GET['delCo'], FILTER_VALIDATE_INT) ) {
        if (filter_var($_GET['va'], FILTER_VALIDATE_INT)) {
            $deleteComment = new comment_article();
            $deleteComment->id = $_GET['delCo'];

            $deleteComment->deleteComment();
            header('Location: ../Moderation-commentaire'.$_GET['va']);
        }
    }
}