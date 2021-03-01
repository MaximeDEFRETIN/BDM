<?php
require_once 'header.php';

require_once '../controllers/validationComment-Controller.php';
?>
<h1 class="center-align">Modération des commentaires !</h1>

<div class="row">
        <div class="col s12">
            <h4 class="center-align">Commentaires validés</h4>
            <table class="highlight responsive-table col s10 offset-s1 centered">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre de l'article</th>
                        <th>Date du commentaire</th>
                        <th>Auteur(e)</th>
                        <th>Commentaire</th>
                        <th>Options</th>
                    </tr>
                </thead>
                    <tbody>   
                        <?php foreach ($commentValided AS $display) { ?>
                            <tr>
                                <td><?= $display->id ?></td>
                                <td><?= $display->title_article ?></td>
                                <td><?= $display->date_comment ?></td>
                                <td><?= $display->author ?></td>
                                <td><?= $display->comment_article ?></td>
                                <td><a class="btn col s12 valided" href="backOffice/validationComment.php?va=<?= $_GET['va'] ?>&valCom=<?= $display->id ?>" title="Invalider">Invalider</a></td>
                                <td><a class="btn col s12" href="backOffice/validationComment.php?va=<?= $_GET['va'] ?>&delCo=<?= $display->id ?>" title="Supprimer un commentaire"><i class="small material-icons">close</i></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
            </table>
        </div>
        <div class="col s12 marginTopMax">
            <h4 class="center-align">Commentaires non validés</h4>
            <table class="highlight responsive-table col s10 offset-s1 centered">
                <thead>
                    <tr>
                        <th>Titre de l'article</th>
                        <th>Date du commentaire</th>
                        <th>Auteur(e)</th>
                        <th>Commentaire</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($commentNoValided AS $display) { ?>
                        <tr>
                            <td><?= $display->title_article ?></td>
                            <td><?= $display->date_comment ?></td>
                            <td><?= $display->author ?></td>
                            <td><?= $display->comment_article ?></td>
                            <td><a class="btn col s12 noValided" href="backOffice/validationComment.php?va=<?= $_GET['va'] ?>&uVaCom=<?= $display->id ?>" title="Valider">Valider</a></td>
                            <td><a class="btn col s12" href="backOffice/validationComment.php?va=<?= $_GET['va'] ?>&delCo=<?= $display->id ?>" title="Supprimer un commentaire"><i class="small material-icons">close</i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
</div>
<?php require_once 'footer.php' ?>