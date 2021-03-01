<?php
require_once 'header.php';

require_once '../controllers/changingArticle-Controller.php';
require_once '../controllers/changingTask-Controller.php';
require_once '../controllers/changingEvent-Controller.php';
require_once '../controllers/changingPage-Controller.php';
?>
<h1 class="center-align">Modifications</h1>
<?php 
$messageUpdate = array($messageUpPage, $messageChangingActuality, $messageChangingTask, $messageChangingEvent);
foreach ($messageUpdate as $simpleMessage) { ?>
    <p class="center-align"><?= implode($simpleMessage) ?></p>
<?php } ?>
<?php if (isset($_GET['chanArt'])) {
    foreach ($displayActuality as $display) {
?>
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
<?php } } else if (isset($_GET['upTas'])) {
     foreach ($displayTask as $display) { ?>
    <h2 class="center-align">Modifier la tâche</h2>
        <form class="input-field col s8 offset-s2" name="updateFormTask" id="updateFormTask" method="POST">
            <divc>
                <input type="text" name="updateTask" id="updateTask" class="validate" title="Tâche" maxlength="25" data-length="25" value="<?= $display->suggested_task ?>" />
                <label for="updateTask" class="black-text">Tâche à modifier</label>
            </div>
            <div class="input-field">
                <textarea id="updateDescription" name="updateDescription" class="materialize-textarea" title="Description" maxlength="200" data-length="200"><?= $display->description_task ?></textarea>
                <label for="updateDescription" class="black-text">Description à modifier</label>
            </div>
            <input type="submit" id="submitUpdateTask" name="submitUpdateTask" class="btn col s6 offset-s3 marginBottomMin" value="Modifier une tâche" title="Tâche à modifier" />
        </form>
        <a class="col s3 offset-s9" href="Taches">Tâches</a>
<?php } } else if (isset($_GET['upEv'])) { 
      foreach ($displayEvent as $display) { ?>
    <h2 class="center-align">Évènement à modifier</h2>
    <form class="col s8 offset-s2 marginTop" name="updateDate" id="updateDate" method="POST" enctype="multipart/form-data">
        <div class="input-field marginTopMin">
            <input type="text" name="updateEvent" id="updateEvent" class="validate" value="<?= $display->suggested_event ?>" maxlength="25" data-length="25" title="Évènement suggérée" />
            <label for="updateEvent" class="black-text">Évènnement suggéré</label>
        </div>
        <div class="input-field marginTopMin">
            <select name="updateStatusEvent" title="Choix du type d'événement">
                <option selected disabled>Choisie un statut</option>
                <option value="Formation">Formation</option>
                <option value="Réunion">Réunion</option>
                <option value="Entre bénévole">Entre bénévole</option>
                <option value="Sortie">Sortie</option>
                <option value="Autres">Autres</option>
            </select>
            <label for="updateStatus" class="black-text">Statut de l'évènnement</label>
        </div>
        <div class="marginTopMin">
            <label for="updateDate" class="black-text">Date de l'évennement</label>
            <input type="date" id="updateDate" class="datepicker" name="updateDate" value="<?= $display->date_event ?>" title="Date" />
        </div>
        <div class="input-field marginTopMin">
            <textarea id="descriptionEvent" name="descriptionEvent" class="materialize-textarea" maxlength="200" data-length="200" title="Description de l'évènement"><?= $display->description_event ?></textarea>
            <label for="descriptionEvent" class="black-text">Description de l'évènnements</label>
        </div>
        <input type="submit" id="submitUpdateEvent" name="submitUpdateEvent" class="btn col s6 offset-s3 marginTopMin" value="Modifier l'évènnement" title="Modifier l'évènement" />
    </form>
    <h2 class="center-align">Documents de l'évènnements</h2>
    <form class="col s8 offset-s2 marginTop" name="updateFile" id="updateFile" method="POST" enctype="multipart/form-data">
        <p>L'évènement <?= (isset($_GET['path']))?'à ce document '.$_GET['path'].'. Laissez le champ vide si vous voulez supprimer le document. Sinon retélécharger-le.':'n\'a aucun document.'?></p>
        <div class="file-field input-field">
          <div class="btn">
            <span>Document</span>
            <input type="file" id="updateFileEvent" name="updateFileEvent" accept=".pdf" />
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" type="text" />
          </div>
        </div>
        <input type="submit" id="submitUpdateFile" name="submitUpdateFile" class="btn col s6 offset-s3 marginTopMin" value="Modifier le fichier" title="Modifier le fichier de l'évènement" />
    </form>
    <a class="col s3 offset-s9" href="Evennements">Évennements</a>
<?php } } else if (isset($_GET['upRea'])) { 
     foreach ($displayGetPage as $display) { ?>
    <h2 class="center-align">Page -> <?= $display->title ?></h2>
    <form method="POST">
        <div class="input-field col s12">
            <input type="text" id="upTitle" name="upTitle" class="validate" maxlength="25" data-length="25" title="Titre" value="<?= $display->title ?>" />
            <label for="upTitle" class="black-text">Titre du livre</label>
        </div>
        <div class="input-field col s12">
            <textarea id="upDescriptionBook" name="upDescriptionBook" class="col s12 materialize-textarea" title="Zone de texte"><?= $display->texte_page ?></textarea>
            <label for="upDescriptionBook" class="black-text">Description du livre</label>
        </div>
        <input type="submit" id="submitUpDescription" name="submitUpDescription" class="btn col s6 offset-s3 marginBottomMin" value="Écrire" title="Envoie la description" />
    </form>
    <a class="col s3 offset-s9" href="Pages">Pages</a>
<?php } } ?>
<?php require_once 'footer.php' ?>