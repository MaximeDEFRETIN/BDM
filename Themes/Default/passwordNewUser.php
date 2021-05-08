<?php
require_once 'headerHome.php';

require_once '../../controllers/newUserPassword-Controller.php';
?>
<div class="fixed-action-btn"><a href="/" class="btn" title="Accueil">Accueil</a></div>
<h1 class="center-align marginTopMin">Choisis un mot de passe pour ton inscription</h1>
<form id="formPasswordNewUser" name="formPasswordNewUser" action="" method="POST" class="marginBottomMin">
    <div class="col s6 offset-s3 input-field inline">
        <input type="password" id="passwordNewUser" name="passwordNewUser" class="validate" minlength="4" maxlength="8" data-length="8" />
        <label for="passwordNewUser" data-error="Il faut au minnimum 4 caractères." data-success="Il y a assez de caractère." class="black-text">Mot de passe</label>
    </div>
    <input type="submit" id="submitNewUser" name="submitNewUser" class="btn col col s4 offset-s4 marginBottomMin" title="Ajouter l'utilisateur" />
</form>
<?php foreach ($passwordNewUserArray as $display) { ?>
    <p class="amber lighten-4 center-align col s10 offset-s1"><?= $display ?></p>
<?php } ?>
<?php require_once 'footerHome.php';