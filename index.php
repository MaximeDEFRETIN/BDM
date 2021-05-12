<?php
//require_once 'models/dataBase.php';
//require_once 'models/themes.php';
require_once 'controllers/themes-Controller.php';

require_once 'Themes/'.$_SERVER['Themes']['Nom'].'/headerHome.php';
require_once 'Themes/'.$_SERVER['Themes']['Nom'].'/accueil.php';
?>
<div class="col s10 offset-s1 marginTop marginBottom">
    <div class="col s6 center-align">
        <?php require_once 'Themes/'.$_SERVER['Themes']['Nom'].'/listeArticles.php' ?>
    </div>
    <div class="col s6 center-align">
        <?php require_once 'Themes/'.$_SERVER['Themes']['Nom'].'/listePages.php' ?>
    </div>
</div>
<?php require_once 'Themes/'.$_SERVER['Themes']['Nom'].'/footerHome.php';