<?php
require_once 'models/dataBase.php';
require_once 'models/themes.php';
require_once 'controllers/themes-Controller.php';

require_once 'Themes/'.$arrayValueTheme['Nom'].'/headerHome.php';
require_once 'Themes/'.$arrayValueTheme['Nom'].'/accueil.php';

require_once 'models/dataBase.php';
require_once 'models/user.php';
require_once 'models/pages.php';
require_once 'models/articles.php';
require_once 'controllers/connection-Controller.php';
require_once 'controllers/mailRecoveryPassword-Controller.php';
require_once 'controllers/Home-Controller.php';
?>
<div class="col s10 offset-s1 marginTop marginBottom">
    <div class="col s6 center-align">
        <?php require_once 'Themes/'.$arrayValueTheme['Nom'].'/listeArticles.php' ?>
    </div>
    <div class="col s6 center-align">
        <?php require_once 'Themes/'.$arrayValueTheme['Nom'].'/listePages.php' ?>
    </div>
</div>
<?php require_once 'Themes/'.$arrayValueTheme['Nom'].'/footerHome.php';