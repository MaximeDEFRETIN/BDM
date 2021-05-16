<?php
require_once 'header.php';

require_once '../controllers/user-Controller.php';

if (!empty($messageUser)) { ?>
    <p class="center-align "><?= implode($messageUser) ?></p>
<?php } ?>
    <div class="col s3 offset-s9 marginTopMin" role="navigation">
        <a class="col s3" href="Articles">Articles</a>
        <a class="col s3" href="Pages">Pages</a>
    </div>
<?php if ($_SESSION['status_user'] !== 'Rédacteur') { ?>
    <div class="row marginTopMin">
        <?php if ($_SESSION['status_user'] === 'Administrateur') { ?>
            <div class="col s10 offset-s1">
                <button data-target="volunteerRegistration" class="btn modal-trigger col s10 offset-s1 marginTopMin" title="Ajouter un bénévole">Ajouter un bénévole</button>
                <div id="volunteerRegistration" class="modal">
                    <div class="modal-content">
                        <h2 class="center-align">Informations sur le bénévole</h2>
                        <form name="volunteerIdentity" id="volunteerIdentity" method="POST" action="">
                            <div class="col s12 input-field">
                                <input type="text" name="last_name" id="last_name" class="validate" maxlength="255" data-length="255" title="Nom" />
                                <label for="last_name" class="black-text">Nom</label>
                            </div>
                            <div class="marginTop col s12 input-field">
                                <input type="text" name="first_name" id="first_name" class="validate" maxlength="255" data-length="255" title="Prénom" />
                                <label for="first_name" class="black-text">Prénom</label>
                            </div>
                            <div class="col s12 input-field inline">
                                <input type="email" name="mail" id="mail" class="validate" maxlength="255" data-length="255" title="Mail" onblur="checkMailUnique()" />
                                <label for="mail" data-error="Adresse mail faussement écris." data-success="Adresse mail correctement écris." class="black-text">Adresse mail</label>
                                <span id="errorCheckMailUnique">Cette addresse mail est déjà utilisée.</span>
                            </div>
                            <input type="submit" id="submitRegistrer" name="submitRegistrer" class="btn col s6 offset-s3 marginBottomMin" value="Enregistrer le bénévole" title="Enregistrer le bénévole" />
                        </form>
                    </div>
                </div>
            </div>
        <?php }?>
        <div class="row">
            <table class="highlight responsive-table col s10 offset-s1 centered center-align">
                <thead>
                    <tr>
                        <th>Nom et prénom du bénévole</th>
                        <th>Statut du bénévole</th>
                        <th>Mail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($displayGetUser as $display) { ?>
                        <tr>
                            <td><?= $display->first_name.' '.$display->last_name ?></td>
                            <td><?= $display->status_user ?></td>
                            <td><?= $display->mail ?></td>
                        </tr>
                        <tr>
                            <?php if ($_SESSION['status_user'] === 'Administrateur') { ?>
                                <td>
                                    <a class="btn <?= ($display->status_user === 'Administrateur')?'disabled':'' ?>" href="Profile-status-Adminsitrateur-utilisateur-<?= $display->id_user ?>" title="Adminsitrateur"><i class="tiny material-icons">face</i></a>
                                </td>
                                <td>
                                    <a class="btn <?= ($display->status_user === 'Rédacteur')?'disabled':'' ?>" href="Profile-status-Redacteur-utilisateur-<?= $display->id_user?>" title="Rédacteur"><i class="tiny material-icons">local_library</i></a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php }
require_once 'footer.php';