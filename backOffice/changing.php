<?php
require_once 'header.php';

require_once '../controllers/changingArticle-Controller.php';
require_once '../controllers/changingPage-Controller.php';
?>
<h1 class="center-align">Modifications</h1>
<?php 
$messageUpdate = array($messageUpPage, $messageChangingActuality);
foreach ($messageUpdate as $simpleMessage) { ?>
    <p class="center-align"><?= implode($simpleMessage) ?></p>
<?php }
if (isset($_GET['chanArt'])) {
    foreach ($displayActuality as $display) { ?>
    <h2 class="center-align">Modification de l'article </h2>
    <form class="row" name="updateArticle" id="updateArticle" method="POST">
        <div class="input-field col s8 offset-s2">
            <input type="text" id="updateTitle" name="updateTitle" class="validate" maxlength="25" data-length="25" title="Titre" value="<?= $display->title ?>" />
            <label for="updateTitle" class="black-text">Titre de l'article</label>
        </div>
        <div class="input-field col s8 offset-s2">
            <textarea id="updateText" name="updateText" class="materialize-textarea" title="Zone de texte"><?= $display->article ?></textarea>
            <label for="updateText" class="black-text">Article</label>
        </div>
        <input type="submit" id="submitUpdateArticle" name="submitUpdateArticle" class="btn col s6 offset-s3 marginBottomMin" value="Écrire" title="Envoie l'article" />
    </form>
    <a class="col s3 offset-s9 marginTopMin marginBottomMin" href="Articles">Articles</a>
    <?php } } else if (isset($_GET['upRea'])) { 
     foreach ($displayGetPage as $display) { ?>
    <h2 class="center-align">Page -> <?= $display->title ?></h2>
    <form method="POST">
        <div class="input-field col s8 offset-s2">
            <input type="text" id="upTitle" name="upTitle" class="validate" maxlength="25" data-length="25" title="Titre" value="<?= $display->title ?>" />
            <label for="upTitle" class="black-text">Titre de la page</label>
        </div>
        <div class="input-field col s8 offset-s2">
            <textarea id="upDescriptionBook" name="upDescriptionBook" class="col s12 materialize-textarea" title="Zone de texte"><?= $display->texte_page ?></textarea>
            <label for="upDescriptionBook" class="black-text">Description de la page</label>
        </div>
        <input type="submit" id="submitUpDescription" name="submitUpDescription" class="btn col s6 offset-s3 marginBottomMin" value="Écrire" title="Envoie la description" />
    </form>
    <span class="fixed-action-btn"><a class="btn col s12" href="Pages">Pages</a></span>
<?php } } ?>
<?php require_once 'footer.php' ?>