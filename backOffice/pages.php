<?php
require_once 'header.php';

require_once '../controllers/pages-Controller.php';

if (!empty($messagePage)) { ?>
    <p class="center-align "><?= implode($messagePage) ?></p>
<?php } ?>
<div class="row marginTopMin">
    <div class="row">
        <table class="highlight responsive-table col s10 offset-s1 centered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Titre de la page</th>
                    <th>Contenu</th>
                    <th>Auteur(e)</th>
                    <th>Date</th>
                    <th>Mise à jour</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($displayReadedBook as $display) { ?>
                    <tr>
                        <td class="justify"><?= $display->id ?></td>
                        <td class="justify"><?= $display->title ?></td>
                        <td class="justify"><?= $display->texte_page ?></td>
                        <td class="justify"><?= $display->first_name ?> <?= $display->last_name ?></td>
                        <td class="justify"><time datetime="<?= $display->date_edited ?>"><?= $display->date_edited ?></time></td>
                        <td class="justify"><time datetime="<?= $display->updateDate ?>"><?= $display->updateDate ?></time></td>
                        <?php if ($display->id_agdjjg_user === $_SESSION['id']) { ?>
                            <td><a href="Changement-lecture-<?= $display->id ?>" class="btn col s12" title="Changer la description du livre"><i class="small material-icons">error</i></a></td>
                            <td><a href="../backOffice/pages.php?delRea=<?= $display->id ?>" class="btn col s12" title="Supprimer la description du livre"><i class="small material-icons">close</i></a></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <ul class="pagination center-align">
            <?php for($i = 0; $i < $pagesBook; $i++) { ?>
                <li>
                    <a href="Page-profile-<?= $i ?>"><?= $i + 1 ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="row">
        <button data-target="readedBook" class="btn modal-trigger col s4 offset-s4 marginBottomMin" title="Écrire un article">Parler d'un livre</button>
        <div id="readedBook" class="modal">
            <div class="modal-content">
                <h2 class="center-align">Le livre que tu as lu ...</h2>
                <form method="POST">
                    <div class="input-field col s12">
                        <input type="text" id="title" name="title" class="validate" maxlength="255" data-length="255" title="Titre" />
                        <label for="title" class="black-text">Titre du livre</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="descriptionBook" name="descriptionBook" class="col s12 materialize-textarea" title="Décris le ivre que tu as lu"></textarea>
                        <label for="descriptionBook" class="black-text">Description du livre</label>
                    </div>
                    <input type="submit" id="submitDescription" name="submitDescription" class="btn col s6 offset-s3 marginBottomMin" value="Écrire" title="Envoie la description" />
                </form>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn"><a class="btn col s12 center-align" href="Profile">Profile</a></div>
</div>
<?php require_once 'footer.php';