<?php
require_once 'header.php';

require_once '../controllers/categorie-Controller.php';

if (!empty($messageCategorie)) { ?>
    <p class="center-align "><?= implode($messagePage) ?></p>
<?php } ?>
<div class="row marginTopMin">
    <div class="row">
        <table class="highlight responsive-table col s10 offset-s1 centered">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nom de la categorie</th>
                    <th>Description</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($categoriesDisplayed as $display) { ?>
                    <tr>
                        <td class="justify" title="N°<?= $display->idCategorie ?>"><?= $display->idCategorie ?></td>
                        <td class="justify" title="Nom : <?= $display->nom ?>"><?= $display->nom ?></td>
                        <td class="justify" title="Description de la catégorie"><?= $display->description ?></td>
                        <td class="justify" title="Crée le <?= $display->dateCreated ?>"><time datetime="<?= $display->dateCreated ?>"><?= $display->dateCreated ?></time></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="fixed-action-btn"><a class="btn col s12 center-align" href="Profile">Profile</a></div>
</div>
<?php require_once 'footer.php';