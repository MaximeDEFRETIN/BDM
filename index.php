<?php require_once 'models/dataBase.php' ?>
<?php require_once 'models/themes.php' ?>
<?php require_once 'controllers/themes-Controller.php' ?>

<?php require_once 'Themes/'.$useTheme->nom.'/headerHome.php' ?>
<?php require_once 'Themes/'.$useTheme->nom.'/accueil.php' ?>
<div class="col s10 offset-s1 marginTop marginBottom">
    <div class="col s6 center-align">
        <?php require_once 'Themes/'.$useTheme->nom.'/listeArticles.php' ?>
    </div>
    <div class="col s6 center-align">
        <?php require_once 'Themes/'.$useTheme->nom.'/listePages.php' ?>
    </div>
</div>
<?php require_once 'Themes/'.$useTheme->nom.'/footerHome.php';