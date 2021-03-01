<?php
require_once 'header.php';

require_once '../controllers/displayTask-Controller.php';
?>
<?php
if (!empty($messageTask)) { ?>
        <p class="center-align "><?= implode($messageTask) ?></p>
<?php } ?>
<div class="row col s10 offset-s1 marginTopMin">
    <button data-target="taskEdit" class="btn modal-trigger col s10 offset-s1 marginBottomMin" title="Ajouter une tâche">Ajouter une tâche à réaliser</button>
    <div id="taskEdit" class="modal">
        <div class="modal-content">
            <h2 class="center-align">Éditer la tâche</h2>
            <form name="formTask" id="formTask" method="POST">
                <div class="marginTop col s12 input-field">
                    <input type="text" name="suggestedTask" id="suggestedTask" class="validate" title="Tâche suggérée" maxlength="255" data-length="255" />
                    <label for="suggestedTask" class="black-text">Tâche suggérée</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="descriptionTask" name="descriptionTask" class="col s12 materialize-textarea" title="Description" maxlength="255" data-length="255"></textarea>
                    <label for="descriptionTask" class="black-text">Description de la tâche</label>
                </div>
                <input type="submit" id="submitTask" name="submitTask" class="btn col s6 offset-s3 marginBottomMin" value="Proposer une nouvelle tâche" title="Nouvellle tâche" />
            </form>
        </div>
    </div>
    <table class="highlight responsive-table col s10 offset-s1 centered">
        <thead>
            <tr>
                <th>N°</th>
                <th>Tâche proposée</th>
                <th>Description</th>
                <th>Statut de la tâche</th>
                <th>Auteur</th>
                <th>Date</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($displayTask as $display) { ?>
                <tr>
                    <td class="justify"><?= $display->id_task ?></td>
                    <td class="justify"><?= $display->suggested_task ?></td>
                    <td class="justify"><?= $display->description_task ?></td>
                    <td><?= $display->status_task ?></td>
                    <td><?= $display->first_name ?> <?= $display->last_name ?></td>
                    <td><time datetime="<?= $display->date_task ?>"><?= $display->date_task ?></time></td>
                    <?php if ($display->status_task !== 'Terminée') { ?>
                        <td><?php if ($display->id_agdjjg_user === $_SESSION['id']) { ?><a class="btn" href="backOffice/taches.php?delTas=<?= $display->id_task ?>" title="Supprimer une tâche"><i class="small material-icons">close</i></a><?php } ?>
                            <a class="btn" href="Ajout-Volontaire-Tache-<?= $display->id_task ?>" title="Ajouter un volontaire"><i class="small material-icons">account_circle</i></a>
                            <a class="btn" href="Modification-status-tache-<?= $display->id_task ?>" title="Changement de statut"><i class="small material-icons">check</i></a>
                            <?php if ($display->id_agdjjg_user === $_SESSION['id']) { ?><a class="btn" href="Changement-tache-<?= $display->id_task ?>" title="Modifier une tâche"><i class="small material-icons">error</i></a><?php } ?>
                            <a class="btn" href="Desistement-<?= $display->id_task ?>" title="Se délister de la tâche"><i class="small material-icons">directions_run</i></a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="highlight responsive-table col s10 offset-s1 centered">
        <thead>
            <tr>
                <th>Tâche suggégérée en cours</th>
                <th>Bénévole y partitcipant</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($displayAssignedVolunter as $display) { ?>
                <tr>
                    <?php if ($display->status_task !== 'Terminée') { ?>
                        <td><?= $display->suggested_task ?></td>
                        <td><?= $display->volunteer ?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once 'footer.php';