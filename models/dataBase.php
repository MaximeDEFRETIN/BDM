<?php
class dataBase {
    // L'attribut $db sera disponible dans ses enfants
    protected $db;
    CONST prefix = 'agdjjg_';
    
    /**
     * Permet de se connecter à la base de donnée grâce à une instance PDO
     */
    function __construct() {
        /*
         * Le try catch permet de récupérer et gérer les erreurs lors de la connexion à la base de donnée
         */
        try {
            $this->db = new PDO('mysql:host=127.0.0.1;dbname=BDM;charset=utf8', 'root', 'AsBc80@0');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
            
    function __destruct() {
        $db = NULL;
    }
}