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