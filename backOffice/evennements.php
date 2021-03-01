<?php
require_once 'header.php';

require_once '../controllers/event-Controller.php';
?>
<?php if (!empty($messageEvent)) {?>
    <p class="center-align "><?= implode($messageEvent) ?></p>
<?php } ?>
<div class="row col offset-s1 s10 marginTopMin">
    <button data-target="eventEdit" class="btn modal-trigger col s10 offset-s1 marginBottomMin" title="Créer un évènnement">Créer un évènnement</button>
    <div id="eventEdit" class="modal">
        <div class="modal-content">
            <h2 class="center-align">Détails de l'évènnement</h2>
            <form name="formEvent" id="formEvent" method="POST" enctype="multipart/form-data">
                <div class="col s12 input-field">
                    <input type="text" name="suggestedEvent" id="suggestedEvent" class="validate" maxlength="255" data-length="255" title="Évènement suggérée" />
                    <label for="suggestedEvent" class="black-text">Évènnement suggéré</label>
                </div>
                <label for="choiceStatus" class="black-text">Statut de l'évènnement</label>
                <select name="statusEvent" class="browser-default" title="Choix du type d'événement">
                    <option disabled selected>Choisie un statut</option>
                    <option value="Formation">Formation</option>
                    <option value="Réunion">Réunion</option>
                    <option value="Entre bénévole">Entre bénévole</option>
                    <option value="Sortie">Sortie</option>
                    <option value="Autres">Autres</option>
                </select>
                <div class="col s12">
                    <label for="dateEvent" class="black-text">Date de l'évennement</label>
                    <input type="date" id="dateEvent" class="datepicker" name="dateEvent" value="<?= date('Y-m-d') ?>" title="Date" />
                </div>
                <div class="input-field col s12">
                    <textarea id="descriptionEvent" name="descriptionEvent" class="materialize-textarea" maxlength="200" data-length="200" title="Description de l'évènement"></textarea>
                    <label for="descriptionEvent" class="black-text">Description de l'évènnements</label>
                </div>
                <input type="button" id="addDocumentEvent" class="btn col s6 offset-s3 marginBottomMin" value="Veux-tu ajouter un document ?" title="Veux-tu ajouter un document ?" />
                <div class="file-field input-field col s12" id="displayInputFileEvent">
                    <div class="btn">
                        <span>Document</span>
                        <input type="file" id="documentFileEvent" name="documentFileEvent" accept=".pdf" />
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
                <input type="submit" id="submitEvent" name="submitEvent" class="btn col s6 offset-s3 marginBottomMin" value="Proposer l'évènnement" title="Proposer l'évènement" />
            </form>
        </div>
    </div>
    <table class="highlight responsive-table col s10 offset-s1 centered marginTopMin">
        <thead>
            <tr>
                <th>N°</th>
                <th>Évènnement</th>
                <th>Description</th>
                <th>Statut</th>
                <th>Auteur</th>
                <th>Date</th>
                <th>Document</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($displayEvent as $display) { ?>
                <tr>
                    <td class="justify"><?= $display->id_event_association ?></td>
                    <td class="justify"><?= $display->suggested_event ?></td>
                    <td class="justify"><?= $display->description_event ?></td>
                    <td class="justify"><?= $display->status_event ?></td>
                    <td class="justify"><?= $display->first_name ?> <?= $display->last_name ?></td>
                    <td class="justify"><time datetime="<?= $display->date_event ?>"><?= $display->date_event ?></time></td>
                    <td class="justify"><?php if($display->path_document_event) { ?><a href="document/<?= $display->path_document_event ?>" target="_blank" title="<?= $display->path_document_event ?>"><?= $display->path_document_event ?></a><?php } ?></td>
                </tr>
                <tr>
                    <td>
                        <a class="btn col s12" href="Profile-ajout-participant-<?= $display->id_event_association ?>" title="Ajouter un participant"><i class="small material-icons">account_circle</i></a>
                    </td>
                    <td>
                        <a class="btn col s12" href="Desistement-evennements-<?= $display->id_event_association ?>" title="Se désister"><i class="small material-icons">directions_run</i></a>
                    </td>
                    <td>
                        <?php if ($display->id_agdjjg_user === $_SESSION['id']) { ?><a class="btn" href="Changement-evenement-<?= $display->id_event_association ?><?= ($display->path_document_event)?'-fichier-'.$display->path_document_event:'' ?>" title="Modifier"><i class="tiny material-icons">error</i></a><?php } ?>
                    </td>
                    <td>
                        <?php if ($display->id_agdjjg_user === $_SESSION['id']) { ?><a class="btn" href="backOffice/evennements.php?delEv=<?= $display->id_event_association ?><?= ($display->path_document_event)?'&path='.$display->path_document_event:'' ?>" title="Supprimer"><i class="tiny material-icons">close</i></a><?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <table class="highlight responsive-table col s10 offset-s1 centered marginTopMin">
        <thead>
            <tr>
                <th>Évènement prochain</th>
                <th>Bénévole y partitcipant</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($displayVolunteerEvent as $display) { ?>
                <tr>
                    <td class="justify"><?= $display->suggested_event ?></td>
                    <td><?= $display->volunteer_present ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php require_once 'footer.php';