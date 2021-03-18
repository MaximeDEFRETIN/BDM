<?php require_once 'headerHome.php' ?>
<p class="col s10 offset-s1 justify marginTop">
    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
<div class="col s10 offset-s1 marginTop marginBottom">
    <div class="col s6 center-align">
        <?php foreach($displayArticle as $display) { ?>
            <a class="col s12" href="Article-<?= $display->id ?>" title="<?= $display->title ?>"><?= $display->title ?></a>
        <?php } ?>
        <ul class="pagination">
            <?php for($i = 0; $i < $pagesHome; $i++) { ?>
                <li>
                    <a href="Article-page<?= $i ?>"><?= $i + 1 ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
    <div class="col s6 center-align">
        <?php foreach($displayReadedBookHome as $display) { ?>
            <a class="col s12" href="Page-<?= $display->id ?>" title="<?= $display->title ?>"><?= $display->title ?></a>
        <?php } ?>
        <ul class="pagination">
            <?php for($i = 0; $i < $pagesBookHome; $i++) { ?>
                <li>
                    <a href="Pages-<?= $i ?>"><?= $i + 1 ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<?php require_once 'Themes/Default/footerHome.php';
