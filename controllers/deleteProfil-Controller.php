<?php
// On instancie un objet
$deleteUser = new user();

// Si il y a une session et que l'utilisateur clique sur le bouton de suppression du profil
if (isset($_POST['profileDelete'])) {
    // On supprime l'avatar de l'utilisateur, quelque soit son format
    array_map('unlink', glob('avatar/' . $_SESSION['id'] . '/*.*'));
    // Puis on supprime le dossier avatar/' . $_SESSION['id']
    rmdir('avatar/' . $_SESSION['id']);
    
    $deleteUser->id = $_SESSION['id'];
    // On appel la méthode pour supprimer l'utilisateur en fonction de son id
    $deleteUser->deleteProfilById();
    
    // On redirige vers la page d'accueil
    header('Location: Accueil');
}
?>