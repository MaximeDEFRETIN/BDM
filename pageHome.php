<?php
require_once 'headerHome.php';

require_once 'controllers/pages-Controller.php';
?>
<div class="fixed-action-btn"><a href="/" class="btn" title="Accueil">Accueil</a></div>
<?php foreach($displayReaded as $display) { ?>
    <article title="Article - <?= $display->title ?>" class="col s6 offset-s3 marginBottomMin marginTopMin article">
        <h4><?= $display->title ?></h4>
        <p class="right-align">écrit le <time class="italic" datetime="<?= $display->date_edited ?>"><?= $display->date_edited ?></time> par <span class="auteur"><?= $display->first_name ?> <?= $display->last_name ?></span></p>
        <?= (isset($display->updateDate))?'<p class="right-align">mise à jour le <time class="italic" datetime="'.$display->updateDate.'">'.$display->updateDate.'</time></p>':'' ?>
        <p class="justify"><?= $display->texte_page ?></p>
    </article>
<?php } ?>
<?php require_once 'footerHome.php';