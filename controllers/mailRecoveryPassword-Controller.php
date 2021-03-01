<?php
// On creée un objet $recoveryPasswordUser
$recoveryPasswordUser = new user();
// $messageRecovery sert à stocker les erreurs
$messageRecovery = array();
// Lorsque l'on clique sur signIn et qu'il n'y a aucune erreur, le formulaire es validé
if (isset($_POST['submitRecovery'])) {
    if(empty($_POST['mailRecovery'])){
        $messageRecovery['emptyMail'] = 'Il faut remplir entièrement le formulaire pour ouvoir récupérer son mot de passe.';
    } else {
    if (!empty($_POST['mailRecovery'])) {
        if (filter_var($_POST['mailRecovery'], FILTER_VALIDATE_EMAIL)) {
            $recoveryPasswordUser->mail = strip_tags($_POST['mailRecovery']);
            // On appelle la méthode
            $key = $recoveryPasswordUser->getKeyByMail();

            // Si la méthode ne renvoie pas false, alors on envoie un mail à l'utilsiateur pour qu'il puisse modifier son mot ed passe
            // Sinon on envoie un message d'erreur
            if ($key != false) {
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=utf-8' . '\r\n';
                $headers .= 'From: Maxime <no-reply@mail.fr>' . '\r\n';
                $to = $recoveryPasswordUser->mail;
                $subject = 'Récupération du mot de passe';
                $message = 'Bonjour !' . "\r\n" . 'Voici un <a href="bdm/Recuperation-mdp-'.$key->key_user.'">lien</a> te permettant de récupérer ton mot de passe.';

                mail($to, $subject, $message,$headers);
                $recoveryPasswordUser->mail = '';
                $messageRecovery['recovery'] = 'Un mail est envoyé !';
            } else {
                $messageRecovery['noMail'] = 'L\'addresse mail que tu as donné ne correspond pas à celui d\'un utilisateur.';
            }
        }
        } else {
            $messageRecovery['emptyMail'] = 'L\'addresse mail n\'est pas donné.';
        }
    }
}
?>