<?php
// On instancie un objet
$passwordNewUser = new user();
// On crée un tableau pour y mettre les messages déstinés à l'utilisateurs
$passwordNewUserArray = array ();

// Lorsque l'utilisateur clique sur le bouton 
if (isset($_POST['submitNewUser'])) {
    // Si le champs correspondant au mot de passe n'est pas vide, on attribut la valeur entrée
    // dans le champs. Le mot de passe est hashé, ce qui permet de le sécuriser
    if (isset($_GET['keyUser']) && filter_var($_GET['keyUser'], FILTER_VALIDATE_INT)) {
            $passwordNewUser->key_user = $_GET['keyUser'];
            // Si le champs correspondant au mot de passe n'est pas vide, on attribut
            // la valeur entrée dans le champs. Le mot de passe est hashé, ce qui permet de le sécuriser
            if (!empty($_POST['passwordNewUser'])) {
                $passwordNewUser->password = password_hash($_POST['passwordNewUser'], PASSWORD_BCRYPT);
                // On utilise la méthode updatePasswordByKey() pour modifier
                // le mot de passe de l'utilisateur
                $passwordNewUser->updatePasswordByKey();
                // On envoie un message à l'utilisateur pour lui indiquer
                // que son mot de passe est bien modifié
                $passwordNewUserArray['passwordNewUser'] = 'Le mot de passe est bien enregistré.';
                // On réinitialise l'attribut password de l'objet user()
                $passwordNewUser->password = '';

              // Si le champ est vide, on envoie un message d'erreur
            } else {
                // On envoie un message à l'utilsiateir pour lui indiquer qu'il n'a pas donné de mot  de passe
                $passwordNewUserArray['noPassword'] = 'Tu n\'as pas donné de mot de passe.';
            }
    } else {
        // On envoie un message à l'utilsiateir pour lui indiquer que l'adressse mail qu'il donne n'est pas bonne
        $passwordNewUserArray['wrongMail'] = 'Ton addresse mail n\'est pas enregistré.';
    }
}
?>