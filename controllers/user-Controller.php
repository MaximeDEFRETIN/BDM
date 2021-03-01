<?php
// Si il y a une session, la liste des bénévoles inscrit sur le site est récupérée pour être affiché
if (isset($_SESSION['id'])) {
    // On instancie un objet
    $getUser = new user();
    $displayGetUser = $getUser->getUser();
}

// On crée un tableau dans lequel il y a les messages destinés à l'utilisateur
$messageUser = array();

// Si il y a une session
if (isset($_SESSION['id'])) {
    // On instancie un objet
    $updateStatusUser = new user();
    // Et que l'utilisateur clique sur le bouton pour changer le statut d'un bénévole
    if (isset($_GET['upUs']) && isset($_GET['idUs'])) {
        if (filter_var($_GET['idUs'], FILTER_VALIDATE_INT) && $_GET['upUs'] === 'Administrateur') {
            // On modifie le statut de l'utilisateur
            $updateStatusUser->updateStatusUserById($_GET['upUs'], $_GET['idUs']);

            if ($_GET['upUs'] === 'Administrateur') {
                $updateStatusUser->updateStatusUserById('Rédacteur', $_SESSION['id']);

                $_SESSION['status_user'] = 'Rédacteur';
            }
        
            $messageUser['updateStatus'] = 'Le statut D=dé l\'utilisateur est bien modifié.';
        }
        
        // On recharge la page
        header('refresh:5; url=Profile');
    }
}

if (isset($_POST['checkMail']) && filter_var($_POST['checkMail'], FILTER_VALIDATE_EMAIL)) {
    session_start();
    include_once '../models/dataBase.php';
    include_once '../models/user.php';
    $mailUnique = new user();
    $mailUnique->mail = htmlspecialchars(strip_tags($_POST['checkMail']));
    $checkMail = $mailUnique->checkMailUnique();
    // On vérifie que $checkMail est différent de false mais pas de 0 ou 1
    if ($checkMail !== false) {
        if ($checkMail == 1) {
            $_SESSION['formError'] = true;
        }
        echo json_encode($checkMail);
    }
} else {
    // On creée l'objet $user
    $user = new user();
    // Les regex servent à vérifier les information entrées dans le formulaire
    // La regex donne comme pattern n'importe quel lettre en majuscule comme 1ère lettre, suivis de n'importe quel lettre minuscule quel que soit leur nombre
    // avec un tiret possible et n'importe quelle lettre majuscule et n'importe quel lettre minuscule
    $regexName = '/^[A-ZÉÈÀÊÀÙÎÏÜË]{1}[a-zéèàêâùïüë]+[-]{0,}[A-ZÉÈÀÊÀÙÎÏÜË]{0,1}[a-zéèàêâùïüë]{0,}/';
    // Indique que n'importe quel caractère peut être choisis tant que le mot de passe a entre 4 et 8 caractères
    $regexPassword = '/^(.){4,8}$/';
    // Lorsque l'on clique sur signIn et qu'il n'y a aucune erreur, le formulaire es validé
    if (isset($_POST['submitRegistrer'])) {
        if(empty($_POST['last_name']) && empty($_POST['first_name']) && empty($_POST['mail'])){
            $messageUser['emptyFormSignIn'] = 'Il faut remplir entièrement le formulaire pour s\'inscrire.';
        } else {
        // On vérifie que les informations entrées dans le formulaire correcpondent à celles qui sont attendues
        if (!empty($_POST['last_name'])) {
            $user->last_name = strip_tags($_POST['last_name']);
            if (!preg_match($regexName, $user->last_name)) {
                $messageUser['wrongLast_name'] = 'Le nom n\'est pas correct.';
            }
        } else {
            $messageUser['emptyLastName'] = 'Le nom n\'est pas donné.';
        }
        if (!empty($_POST['first_name'])) {
            $user->first_name = strip_tags($_POST['first_name']);
            if (!preg_match($regexName, $user->first_name)) {
                $messageUser['wrongFirst_name'] = 'Le prenom n\'est pas correct.';
            }
        } else {
            $messageUser['emptyFirstName'] = 'Le prénom n\'est pas donné.';
        }
        if (!empty($_POST['mail'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $user->mail = $_POST['mail'];
            } else {
                $messageUser['wrongMail'] = 'L\'adresse mail n\'est pas correcte';
            }
        } else {
            $messageUser['emptyMail'] = 'L\'addresse mail n\'est pas donné.';
        }

        $user->key_user = rand(1000, 9999);

        // Si $user ne correspond pas au model, alors on envoie un message d'erreur
        if (count($messageUser) == 0) {
            // On appelle la méthode
            $user->addUser();

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . '\r\n';
            $headers .= 'From: Maxime <no-reply@bdm.fr>' . '\r\n';
            $to = $user->mail;
            $subject = 'Finalisation de l\'inscription.';
            $message = 'Bonjour !' . "\r\n" . 'Voici un <a href="https://'.$_SERVER['HTTP_HOST'].'/Nouveau-mdp-'.$user->key_user.'">lien</a> te permettant de choisir ton mot de passe.';

            mail($to, $subject, $message,$headers); 

            $user->last_name = '';
            $user->first_name = '';
            $user->mail = '';
            $user->key_user = '';
            $messageUser['add'] = 'L\'inscription du nouveau utilisateur est réussie !';
            
            header('refresh:5; url=Profile');
            }
        }
    }
}