<?php
// On instancie un nouveau objet
$countReadedBookHome = new pages();

// On appel la méthode pour compter le nombre d'article dans la base dee donnée
$countHome = $countReadedBookHome->countPages();
// On calcule le nombre de page pour la pagination des articles
$pagesBookHome = ceil($countHome->id_count / 3);

// On récupère les articles
$getReadedBookHome = new pages();

// Si il n'y a pas la variable $_GET['paReh'] ou qu'elle n'est pas inférieur ou égale à 0,
// la variable vaut automatiquement 0 et on affiche les 3 premiers articles
if (!isset($_GET['paReh']) || $_GET['paReh'] <= 0) {
    $displayReadedBookHome = $getReadedBookHome->getPages(0);
// Si il y a bien une variable $_GET['paReh'],
// on attribut la valeur de $_GET['paReh'] à la variable $page
} else if (isset($_GET['paReh'])) {
    if (filter_var($_GET['paReh'], FILTER_VALIDATE_INT)) {
        $displayReadedBookHome = $getReadedBookHome->getPages($_GET['paReh']);
    } else {
        header('Location: /');
    }
}

$getReaded = new pages();

// Si un utilisateur cique sur un idRe
if (isset($_GET['idRe'])) {
    if (filter_var($_GET['idRe'], FILTER_VALIDATE_INT)) {
        // On récupère son id
        $getReaded->id = $_GET['idRe'];

        // Et on le récupère
        $displayReaded = $getReaded->getPageById();
    }
}

$countArticleHome = new articles();

$countHome = $countArticleHome->countArticle();
$pagesHome = ceil($countHome->idCount / 3);

$getArticle = new articles();
if (!isset($_GET['page']) || $_GET['page'] <= 0) {
    $displayArticle = $getArticle->getArticle(0);
} else if (isset($_GET['page'])) {
    if (filter_var($_GET['page'], FILTER_VALIDATE_INT)) {
        $displayArticle = $getArticle->getArticle($_GET['page']);
    } else {
        header('Location: /');
    }
}

$inscription = new user();
$messageInscription = array();
$regexName = '/^[A-ZÉÈÀÊÀÙÎÏÜË]{1}[a-zéèàêâùïüë]+[-]{0,}[A-ZÉÈÀÊÀÙÎÏÜË]{0,1}[a-zéèàêâùïüë]{0,}/';

if (isset($_POST['submitRegistrer'])) {
        if(empty($_POST['last_name']) && empty($_POST['first_name']) && empty($_POST['mail'])){
            $messageInscription['emptyFormSignIn'] = 'Il faut remplir entièrement le formulaire pour s\'inscrire.';
        } else {
        // On vérifie que les informations entrées dans le formulaire correcpondent à celles qui sont attendues
        if (!empty($_POST['last_name'])) {
            $inscription->last_name = strip_tags($_POST['last_name']);
            if (!preg_match($regexName, $inscription->last_name)) {
                $messageInscription['wrongLast_name'] = 'Le nom n\'est pas correct.';
            }
        } else {
            $messageInscription['emptyLastName'] = 'Le nom n\'est pas donné.';
        }
        if (!empty($_POST['first_name'])) {
            $inscription->first_name = strip_tags($_POST['first_name']);
            if (!preg_match($regexName, $inscription->first_name)) {
                $messageInscription['wrongFirst_name'] = 'Le prenom n\'est pas correct.';
            }
        } else {
            $messageInscription['emptyFirstName'] = 'Le prénom n\'est pas donné.';
        }
        if (!empty($_POST['mail'])) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $inscription->mail = $_POST['mail'];
            } else {
                $messageInscription['wrongMail'] = 'L\'adresse mail n\'est pas correcte';
            }
        } else {
            $messageInscription['emptyMail'] = 'L\'addresse mail n\'est pas donné.';
        }

        $inscription->key_user = rand(1000, 9999);

        // Si $user ne correspond pas au model, alors on envoie un message d'erreur
        if (count($messageInscription) == 0) {
            // On appelle la méthode
            $inscription->addUser();

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . '\r\n';
            $headers .= 'From: Maxime <no-reply@bdm.fr>' . '\r\n';
            $to = $inscription->mail;
            $subject = 'Finalisation de l\'inscription.';
            $message = 'Bonjour !' . "\r\n" . 'Voici un <a href="https://'.$_SERVER['HTTP_HOST'].'/Nouveau-mdp-'.$inscription->key_user.'">lien</a> te permettant de choisir ton mot de passe.';

            mail($to, $subject, $message,$headers); 

            $inscription->last_name = '';
            $inscription->first_name = '';
            $inscription->mail = '';
            $inscription->key_user = '';
            $messageUser['add'] = 'Ton inscription est réussie !';
        }
    }
}