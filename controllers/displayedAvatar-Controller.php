<?php
// On instancie un objet
$avatarProfile = new user();

$avatarDisplayed=($_SESSION['id'])?$avatarProfile->getAvatarById($_SESSION['id']):'';