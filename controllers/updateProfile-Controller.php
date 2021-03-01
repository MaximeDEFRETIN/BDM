<?php
// On isntancie un nouvel objet
$profilUpdate = new user();
// La régex sert à vérifier que l'utilisateur rentre une adresse mail selon un format prédéfinis
$regexUpdateName = '/^[A-ZÉÈÀÊÀÙÎÏÜË]{1}[a-zéèàêâùïüë]+[-]{0,}[A-ZÉÈÀÊÀÙÎÏÜË]{0,1}[a-zéèàêâùïüë]{0,}/';
// On crée un tableau pour y mstocker les messages d'erreur
$messageModification = array();

// Si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
// On attribut à $profilUpdate->id l'id de l'utilisateur
$profilUpdate->id = $_SESSION['id'];

    // Si l'utilisateur clique sur l bouton d'envoie
    if (isset($_POST['updateProfile'])) {
        // Si le champs correspondant au nom n'est pas vide, on attribut la valeur entrée dans le champs
        if (!empty($_POST['last_nameUpdate'])) {
            if (preg_match($regexUpdateName, $_POST['last_nameUpdate'])) {
                $profilUpdate->last_name = htmlspecialchars(strip_tags($_POST['last_nameUpdate']));
            } else {
                $messageModification['last_nameWrong'] = 'Le nom n\'est pas correcte !';
            }
        } else {
            $messageModification['last_nameNoUpdate'] = 'Le nom n\'a pas pu être modifier.';
        }

        // Si le champs correspondant au prénom n'est pas vide, on attribut la valeur entrée dans le champs
        if (!empty($_POST['first_nameUpdate'])) {
            if (preg_match($regexUpdateName, $_POST['first_nameUpdate'])) {
                $profilUpdate->first_name = htmlspecialchars(strip_tags($_POST['first_nameUpdate']));
            } else {
                $messageModification['first_nameWrong'] = 'Le prénom n\'est pas correcte !';
            }
        } else {
            $messageModification['first_nameNoUpdate'] = 'Le prénom n\'a pas pu être modifier.';
        }

        // Si le champs correspondant au mailUpdate n'est pas vide, on attribut la valeur entrée dans le champs
        if (!empty($_POST['mailUpdate'])) {
            if (filter_var($_POST['mailUpdate'], FILTER_VALIDATE_EMAIL)) {
                $profilUpdate->mail = strip_tags($_POST['mailUpdate']);
            } else {
                $messageModification['mailWrong'] = 'L\'adresse mail n\'est pas correcte !';
            }
        } else {
            $messageModification['mailNoUpdate'] = 'L\'adresse mail n\'a pas pu être modifier.';
        }

        // Si il n'y a aucune erreur
        if (count($messageModification) == 0) {
            // Si la modification du profil n'a pas pu être effectué, alors on envoie un message d'erreur
            if (!$profilUpdate->updateProfile()) {
                $messageModification['noUpdateProfil'] = 'Erreur lors de la modification du nom du profil.';
              // Sinon le profil est modifié
            } else {
                $_SESSION['last_name'] = $profilUpdate->last_name;
                $_SESSION['first_name'] = $profilUpdate->first_name;
                $_SESSION['mail'] = $profilUpdate->mail;
                
                $messageModification['updateProfil'] = 'Les modifications ont pu être fait.';
                
                $profilUpdate->last_name = '';
                $profilUpdate->first_name = '';
                $profilUpdate->mail = '';
                
                header('refresh:5; url=Modification-profile');
            }
        }
    }
}

// On crée la variable insertSuccess pour s'asurer de la réussite de la modification du profil
$insertSuccessUpdatePassword = false;
// On instancie un nouvlel objet
$updatePassword = new user();
// On crée tableau contenant les messages d'erreurs
$messageUpdatePassword = array();

// Si l'utilisateur est connecté
 if (isset($_SESSION['id'])) {
     // On attribut à $profilUpdate->id l'id de l'utilisateur
    $updatePassword->id = $_SESSION['id'];
        
    // Lorsque l'utilisateur clique sur le bouton 
    if (isset($_POST['submitPassword'])) {
        // Si le champs correspondant au mot de passe n'est pas vide, on attribut la valeur entrée dans le champs.
        // Le mot de passe est hashé, ce qui permet de le sécuriser
        if (!empty($_POST['passwordUpdate'])) {
            $updatePassword->password = password_hash($_POST['passwordUpdate'], PASSWORD_BCRYPT);
          // Si le champ est vide, on envoie un message d'erreur
        } else {
            $messageUpdatePassword['password'] = 'Il faut donner un mot de passe pour le modifier.';
        }

        // Si il n'y a aucune erreur
        if (count($messageUpdatePassword) == 0) {
            // Si la modification du mot de passe n'a pas pu être effectué, alors on envoie un message d'erreur
            if (!$updatePassword->updatePassword()) {
                // Si le mot de passe n'a pas pu êter changé, alors on envoie u message d'erreur
                $messageUpdatePassword['errorPassword'] = 'Erreur lors de la modification du mot de passe.';
              // Sinon le profil est modifié
            } else {
                $insertSuccessUpdatePassword = true;
                $messageUpdatePassword['updatePassword'] = 'Le mot de passe a bien été modifié.';

                $updatePassword->password = '';
                
                header('refresh:5; url=Modification-profile');
            }
        }
    }
}