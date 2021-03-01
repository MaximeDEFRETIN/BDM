<?php
// On instancie un objet
$replacePassword = new user();
// On crée un tableau pour y mettre les messages déstinés à l'utilisateurs
$replacePasswordMessage = array ();

// Lorsque l'utilisateur clique sur le bouton 
if (isset($_POST['submitRecoveryPassword'])) {
    // Si le champs correspondant au mot de passe n'est pas vide, on attribut la valeur entrée
    // dans le champs. Le mot de passe est hashé, ce qui permet de le sécuriser
    if (isset($_GET['keyUser'])) {
        if (filter_var($_GET['keyUser'], FILTER_VALIDATE_INT)) {
            $replacePassword->key_user = $_GET['keyUser'];
            // Si le champs correspondant au mot de passe n'est pas vide, on attribut
            // la valeur entrée dans le champs. Le mot de passe est hashé, ce qui permet de le sécuriser
            if (!empty($_POST['recoveryPassword'])) {
                $replacePassword->password = password_hash($_POST['recoveryPassword'], PASSWORD_BCRYPT);
                // On utilise la méthode updatePasswordByMail() pour modifier
                // le mot de passe de l'utilisateur
                $replacePassword->updatePasswordByKey();
                // On envoie un message à l'utilisateur pour lui indiquer
                // que son mot de passe est bien modifié
                $replacePasswordMessage['replacePassword'] = 'Le mot de passe est bien enregistré.';
                // On réinitialise l'attribut password de l'objet user()
                $replacePassword->password = '';

              // Si le champ est vide, on envoie un message d'erreur
            } else {
                // On envoie un message à l'utilsiateir pour lui indiquer qu'il n'a pas donné de mot  de passe
                $replacePasswordMessage['noPassword'] = 'Tu n\'as pas donné de mot de passe.';
            }
        }
    }
}
?>