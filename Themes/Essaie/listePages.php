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