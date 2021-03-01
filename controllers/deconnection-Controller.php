<?php
    // Démare une session
    session_start();
    // session_unset() vide la session en cour
    session_unset();
    // session_destroy() détruit la session en cours
    session_destroy();
    
    header('Location: /');
    
    exit;
