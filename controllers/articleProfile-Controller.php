<?php
$messageArticle = array();

if (isset($_POST['submitArticle'])) {
    $articles = new articles();
    if(empty($_POST['titleArticle']) && empty($_POST['article'])){
        $messageArticle['emptyFormArticle'] = 'Il faut remplir entièrement le formulaire pour publier un article.';
    } else {
        $regexText = '/[A-ZÉÈÀÊÀÙÎÏÜËa-zéèàêâùïüë0-9.\-\'~$£%*#{}()`ç+=œ“€\/:;,!]+/';
        if (!empty($_POST['titleArticle'])) {
            if (preg_match($regexText, $_POST['titleArticle'])) {
                $articles->title = htmlspecialchars(strip_tags($_POST['titleArticle']));
            } else {
                $messageArticle['titleWrong'] = 'Le titre n\'est pas correcte !';
            }
        } else {
            $messageArticle['emptyTitleArticle'] = 'Le titre n\'est pas donné.';
        }
        if (!empty($_POST['article'])) {
            if (preg_match($regexText, $_POST['titleArticle'])) {
                $articles->article = htmlspecialchars(strip_tags($_POST['article']));
            } else {
                $messageArticle['textWrong'] = 'Le texte n\'est pas correcte !';
            }
        } else {
            $messageArticle['emptyArticle'] = 'L\'article n\'est pas donné.';
        }

        $articles->id_agdjjg_user = $_SESSION['id'];

        if (count($messageArticle) == 0) {
            $articles->addArticle();

            $articles->article = '';
            $articles->title = '';
            $articles->id_agdjjg_user = 0;

            $messageArticle['add'] = 'L\'article a été ajouté !';

            header('refresh:5; url=Articles');
        }
    }
}

$countArticle = new articles();

$count = $countArticle->countArticle();
$pages = ceil($count->idCount / 3);

$getArticle = new articles();

if (!isset($_GET['paPro']) || $_GET['paPro'] < 0) {
    $displayArticleProfile = $getArticle->getArticle(0);
} else if (isset($_GET['paPro'])) {
    if (filter_var($_GET['paPro'], FILTER_VALIDATE_INT)) {
        $displayArticleProfile = $getArticle->getArticle($_GET['paPro']);
    } else {
        header('Location: Articles');
    }
}

    
// Si un utilisateur clique sur un bouton supprimer
if (isset($_GET['delAct'])) {
    if (filter_var($_GET['delAct'], FILTER_VALIDATE_INT)) {
        $deleteArticle = new articles();
        $deleteArticle->id = $_GET['delAct'];
        $deleteArticle->deleteArticleById();
        header('Location: Articles');
    } else {
        header('Location: Articles');
    }
}