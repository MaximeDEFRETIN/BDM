<?php
// On instancie un objet
$getArticle = new articles();
// Si un utilisateur cique sur un article
if (isset($_GET['art'])) {
    if (filter_var($_GET['art'], FILTER_VALIDATE_INT)) {
        // On récupère son id
        $getArticle->id = $_GET['art'];
        // Et on le récupère
        $displayArticle = $getArticle->getArticleById();
    }
}

// On instancie un objet
$displayCommentHome = new comment_article();

// On récupère chaque article en fonction de leur id, pour les afficher
if (isset($_GET['art'])) {
    if (filter_var($_GET['art'], FILTER_VALIDATE_INT)) {
        $displayCommentHome->id_agdjjg_article = $_GET['art'];
        $commentsHomeList = $displayCommentHome->getCommentArticleById(1);
    } else {
        header('Location: Profile');
    }
}