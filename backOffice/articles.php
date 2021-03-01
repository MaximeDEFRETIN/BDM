<?php
require_once 'header.php';

require_once '../controllers/articleProfile-Controller.php';

if (!empty($messageArticle)) {
?>
        <p class="center-align "><?= implode($messageArticle) ?></p>
<?php } ?>
<div class="row marginTopMin">
    <div class="row">
        <table class="highlight responsive-table col s10 offset-s1 centered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Titre</th>
                    <th>Articles</th>
                    <th>Auteur(e)</th>
                    <th>Date</th>
                    <th>Date de mise à jour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($displayArticleProfile as $display) { ?>
                    <tr>
                        <td class="justify"><?= $display->id ?></td>
                        <td class="justify"><?= $display->title ?></td>
                        <td class="justify"><?= $display->article ?></td>
                        <td class="justify"><?= $display->first_name ?> <?= $display->last_name ?></td>
                        <td class="justify"><time datetime="<?= $display->date_article ?>"><?= $display->date_article ?></time></td>
                        <td class="justify"><time datetime="<?= $display->updateDate ?>"><?= $display->updateDate ?></time></td>
                        <?php if ($_SESSION['status_user'] === 'Président') { ?>
                            <td><a class="btn col s12" href="Moderation-commentaire<?= $display->id ?>" title="Modérer les commentaiers reçus"><i class="small material-icons">thumbs_up_down</i></a></td>
                            <td><a class="btn col s12" href="Changement-article-<?= $display->id ?>" title="Modifier une actualité"><i class="small material-icons">error</i></a></td>
                            <td><a class="btn col s12" href="Suppression-actualite-<?= $display->id ?>" title="Supprimer une actualité"><i class="small material-icons">close</i></a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <ul class="pagination center-align">
            <?php for($i = 0; $i < $pages; $i++) { ?>
                <li>
                    <a href="Page-actualité-<?= $i ?>"><?= $i + 1 ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <?php if ($_SESSION['status_user'] === 'Président') { ?>
        <div class="row marginTopMin">
            <button data-target="article" class="btn modal-trigger col s4 offset-s4 marginBottomMin" title="Écrire un article">Écrire un article</button>
            <div id="article" class="modal">
                <div class="modal-content">
                    <h2 class="center-align">Écrire l'article</h2>
                    <form name="writingArticle" id="writingArticle" method="POST">
                        <div class="input-field col s12">
                            <input type="text" id="titleArticle" name="titleArticle" class="validate" maxlength="25" data-length="25" title="Titre" />
                            <label for="title" class="black-text">Titre de l'article</label>
                        </div>
                        <div class="input-field col s12">
                            <textarea id="article" name="article" class="col s12 materialize-textarea" title="Zone de texte"></textarea>
                            <label for="article" class="black-text">Article</label>
                        </div>
                        <input type="submit" id="submitArticle" name="submitArticle" class="btn col s6 offset-s3 marginBottomMin" value="Écrire" title="Envoie l'article" />
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php require_once 'footer.php';