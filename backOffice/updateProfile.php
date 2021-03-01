<?php
require_once 'header.php';
require_once '../controllers/updateProfile-Controller.php';
require_once '../controllers/avatar-Controller.php';
require_once '../controllers/deleteProfil-Controller.php';
?>
<div class="row">
    <div class="row marginTopMin center-align">
        <img src="<?= (isset($avatarDisplayed->path_avatar)?$avatarDisplayed->path_avatar:"assets/img/imgDefault.png") ?>"  height="150" width="150" class="circle responsive-img" id="avatar" title="Avatar" alt="Avatar de <?= $_SESSION['last_name'] . ' ' . $_SESSION['first_name'] ?>" />
        <form id="formNewAvatar" class="marginTopMin  col s10 offset-s1" action="" method="post" enctype="multipart/form-data">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Avatar</span>
                        <input type="file" id="avatarFile" name="avatarFile" accept=".png, .jpg, .jpeg" />
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" />
                    </div>
                </div>
            <?php if (!isset($avatarDisplayed->path_avatar)) { ?>
                <input type="submit" id="newAvatar" name="newAvatar" value="Nouveau avatar" class="col s4 offset-s4 btn" title="Ajout d'un avatar" />
            <?php } else { ?>
                <input type="submit" id="deleteAvatar" name="deleteAvatar" value="Supprimer l'avatar" class="col s4 offset-s4 btn" title="Supprimer l'avatar" />
            <?php } ?>
        </form>
    </div>
    <?php foreach ($messageAvatar as $display) { ?>
        <p class="amber lighten-4 center-align col s10 offset-s1"><?= $display ?></p>
    <?php } ?>
    <?php foreach ($messageModification as $display) { ?>
        <p class="amber lighten-4 center-align col s10 offset-s1"><?= $display ?></p>
    <?php } ?>
    <?php foreach ($messageUpdatePassword as $display) { ?>
        <p class="amber lighten-4 center-align col s10 offset-s1"><?= $display ?></p>
    <?php } ?>
  <div class="row marginTopMin col s10 offset-s1">
    <form method="post" action="">
            <div class="input-field">
                <input type="text" name="last_nameUpdate" id="last_nameUpdate" class="validate center-align" value="<?= $_SESSION['last_name'] ?>" maxlength="25" data-length="25" title="Nouveau nom" />
                <label for="last_nameUpdate" class="black-text center-align">Nom</label>
            </div>
            <div class="marginTopMin input-field">
                <input type="text" name="first_nameUpdate" id="first_nameUpdate" class="validate center-align" value="<?= $_SESSION['first_name'] ?>" maxlength="25" data-length="25" title="Nouveau prénom" />
                <label for="first_nameUpdate" class="black-text center-align">Prénom</label>
            </div>
            <div class="marginTopMin input-field">
                <input type="email" name="mailUpdate" id="mailUpdate" class="validate center-align" value="<?= $_SESSION['mail'] ?>" maxlength="70" data-length="70" title="Nouveau mail" />
                <label for="mailUpdate" class="black-text center-align">Adresse mail</label>
            </div>
            <div class="center-align marginTopMin">
                <input type="submit" class="btn" value="Envoyer" id="updateProfile" name="updateProfile" title="Modifier le profil" />
            </div>
      </form>
    <div class="row marginTopMin">
        <form action="" method="post">
            <div class="input-field center-align">
                <input type="password" name="passwordUpdate" id="passwordUpdate" name="passwordUpdate" class="validate black-text" minlength="4" maxlength="8" data-length="8" title="Nouveau mot de passe" />
                <label for="passwordUpdate" class="black-text">Mot de passe</label>
            </div>
            <div class="center-align marginTopMin">
                <input type="submit" class="btn" value="Envoyer" id="submitPassword" name="submitPassword" title="Changement de mot de passe" />
            </div>
        </form>
    </div>
  </div>
</div>
<div class="row marginTopMin center-align">
    <form method="post" action="">
        <input type="submit" class="btn <?= ($_SESSION['status_user'] === 'Président')?'disabled':'' ?>" name="profileDelete" value="Tu veux supprimer ton profil ?" title="Veux-tu supprimer ton profi ?" />
    </form>
</div>
<?php require_once 'footer.php' ?>