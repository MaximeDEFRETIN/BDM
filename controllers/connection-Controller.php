<?php
// Temporise les données afin qu'elle ne soient pas envoyé immédiatement
ob_start();

//// On instancie un objet
$userConnection = new user();
// $connectionMessage sert à stocker les messages destiné à l'utilisateur
$connectionMessage = array();

// Si on clique sur connection
if (isset($_POST['submitConnection'])) {
    if (!empty($_POST['mailConnection']) && !empty($_POST['passwordConnection'])) {
        // Et si le champ correspondant au mail n'est pas vide
        if (!empty($_POST['mailConnection']) && filter_var($_POST['mailConnection'], FILTER_VALIDATE_EMAIL)) {
            // On vérifie que le mail rentré est correcte
                // On attribut à $userConnection->mail le mail rentré, strip_tags supprime les balises HTML et PHP
                $userConnection->mail = $_POST['mailConnection'];
                $userConnection->getUserByMail();
        // Si aucun mail n'est donné, on envoie un message d'erreur
        } else {
            $connectionMessage['emptyMail'] = 'Tu n\'as pas entré ton adresse mail.';
        }

        // On vérifie si le champs correspondant au mot de passer n'est pas vide
        if (!empty($_POST['passwordConnection'])) {
            // On vérifie si le mot de passe entré correspon au mot de passe dans la base de donnée
            if (password_verify($_POST['passwordConnection'], $userConnection->password)) {
                // Si le mot de passe est vérifié on attribut la valeur du champ à $userConnection->password
                $userConnection->password = $_POST['passwordConnection'];
                // Si le mot de passe ne correspond pas à celui entré dans la base de donnée, on envoie un message d'erreur
                } else {
                    $connectionMessage['wrongPassword'] = 'Le mot de passe que tu as donné n\'est pas correcte.';
                }
          // Si le champ du mot de passe est vide, on affiche un mot de passe
        } else if (empty($_POST['passwordConnection'])){
            $connectionMessage['emptyPassword'] = 'Il faut donner un mot de passe.';
        }

        // Si il n'y a aucune erreur, alors on crée une session après avoir récupéré les informations sur l'utilisateur
        if (count($connectionMessage) == 0) {
            // session_start() permet de démarrer une session
            session_start();

            // $_SESSION permet de garder les informations lié à un utilisateur lorsqu'il est connecté
            $_SESSION['id'] = $userConnection->id;
            $_SESSION['last_name'] = $userConnection->last_name;
            $_SESSION['first_name'] = $userConnection->first_name;
            $_SESSION['mail'] = $userConnection->mail;
            $_SESSION['status_user'] = $userConnection->status_user;

            // header() redirige vares la page indiquée
            header('Location: Profile');

            // exit termine le script
            exit;
        }
    } else {
        $connectionMessage['emptyForm'] = 'Il faut que tu remplisse le formulaire pour te connecter.';
    }
}

// Envoie les données temporisées et met fin à la temporisation des données
ob_end_flush();

//$connectionMessage = array();
//if (isset($_POST['mailConnection'])) {
//    session_start();
//    require_once '../models/dataBase.php';
//    require_once '../models/user.php';
//    $userConnection = new user();
//    if (filter_var($_POST['mailConnection'], FILTER_VALIDATE_EMAIL)) {
//        $userConnection->mail = $_POST['mailConnection'];
//        $userConnection->getUserByMail();
//    } else {
//        echo $connectionMessage = 'Ce n\'est pas un mail';
//    }
//
//    if (!empty($_POST['passwordConnection'])) {
//        if (!password_verify($_POST['passwordConnection'], $userConnection->password)) {
//            echo $connectionMessage = 'Le mot de passe est faux.';
//        }
//    } else {
//        echo $connectionMessage = 'Pas de mot de passe.';
//    }
//
//    if (empty($connectionMessage)) {
//        
//        session_start();
//
//        $_SESSION['id'] = $userConnection->id;
//        $_SESSION['last_name'] = $userConnection->last_name;
//        $_SESSION['first_name'] = $userConnection->first_name;
//        $_SESSION['mail'] = $userConnection->mail;
//        $_SESSION['status_user'] = $userConnection->status_user;
//        
//        echo json_encode($_SESSION);
//    }
//}