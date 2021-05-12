<?php
require_once 'headerHome.php';

require_once '../../models/comment_article.php';
require_once '../../controllers/articleHome-Controller.php';
require_once '../../controllers/commentArticle-Controller.php';

$message = array($messageAnswer, $messageComment);
    foreach ($message as $simpleMessage) { ?>
        <p class="center-align "><?= implode($simpleMessage) ?></p>
    <?php } ?>
    <div class="fixed-action-btn"><a href="/" class="btn" title="Accueil">Accueil</a></div>
    <?php foreach($displayArticle as $display) { ?>
        <article title="Article - <?= $display->title ?>" class="container marginBottomMin marginTopMin article">
            <h4><?= $display->title ?></h4>
            <p class="right-align">écrit le <time class="italic" datetime="<?= $display->date_article ?>"><?= $display->date_article ?></time> par <span class="auteur"><?= $display->first_name ?> <?= $display->last_name ?></span></p>
            <?= (isset($display->updateDate))?'<p class="right-align">mise à jour le <time class="italic" datetime="'.$display->updateDate.'">'.$display->updateDate.'</time></p>':'' ?>
            <p class="justify"><?= $display->article ?></p>
        </article>
    <?php } ?>
    <div class="col s6 offset-s3 sizeComment">
        <?php foreach ($commentsHomeList as $display) { ?>
            <div class=" marginTop marginBottom" id="<?= $display->id ?>" <?= ($display->id_answer_comment !== null)?'answer="'.$display->id_answer_comment.'"':'' ?>>
                <p class="justify"><?= $display->comment_article ?></p>
                <p class="right-align">de <span class="bold"><?= $display->author ?></span>, le <time class="italic" datetime="<?= $display->date_comment ?>"><?= $display->date_comment ?></time></p>
                <?= ($display->id_answer_comment === null)?'<a class="buttonAnswer btn" id="disp'.$display->id.'" onclick="displayAnswer('.$display->id.')">Afficher les réponses</a>':'' ?>
                <?= ($display->id_answer_comment === null)?'<a class="buttonAnswer btn" id="'.$display->id.'" onclick="formAnswer('.$display->id.')">Répondre</a>':'' ?>
            </div>
        <?php } ?>
    </div>
    <form method="POST" class="col s6 offset-s3 marginBottom">
        <div class="marginTop col s12 input-field">
            <input type="text" name="authorComment" id="authorComment" class="validate" title="Prénom" maxlength="255" data-length="255" />
            <label for="authorComment" class="black-text">Ton prénom</label>
        </div>
        <div class="input-field col s12">
            <textarea id="comment" name="comment" class="col s12 materialize-textarea" title="Zone de commentaire" maxlength="200" data-length="200"></textarea>
            <label for="comment" class="black-text">Le commentaire</label>
        </div>
        <input type="submit" id="submitComment" name="submitComment" class="btn col s6 offset-s3" value="Commenter" title="Envoie du commentaire écris" />
    </form>
<?php require_once 'footerHome.php';