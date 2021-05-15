<?php
// On instancie un objet
$getArticle = new articles();
(isset($_GET['art']))?(filter_var($_GET['art'], FILTER_VALIDATE_INT))?$displayArticle = $getArticle->getArticleById($_GET['art']):'':'';

// On instancie un objet
$displayCommentHome = new comment_article();

(isset($_GET['art']))? (filter_var($_GET['art'], FILTER_VALIDATE_INT))?$commentsHomeList = $displayCommentHome->getCommentArticleById(1, $_GET['art']):header('Location: Profile'):'';