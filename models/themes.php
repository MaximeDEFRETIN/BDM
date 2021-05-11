<?php
class themes extends dataBase {

    public $nom = '';
    public $auteur = '';
    public $version = '';
    public $date = '';
    public $maj = '';
    public $description = '';


    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet de récupérer les thèmes
     */
    public function getThemes() {
        // On prépare la requête
        $requestGetThemesResult = $this->db->prepare('SELECT `id`, `nom`, `auteur`, `version`, `date`, `maj`, `description` FROM `'.self::prefix.'Themes`');
        // Si la requête est exécutée
        if ($requestGetThemesResult->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetThemesResult)) {
                return $requestGetThemesResult = $requestGetThemesResult->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet de récupérer le thème choisi par l'utilisateur
     */
    public function getThemeHome() {
        // On prépare la requête
        $requestGetThemeHomeResult = $this->db->prepare('SELECT `nom`, `auteur`, `version`, `date`, `maj` FROM `'.self::prefix.'Themes` WHERE `choix` = 1');
        // Si la requête est exécutée
        if ($requestGetThemeHomeResult->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetThemeHomeResult)) {
                return $requestGetThemeHomeResult = $requestGetThemeHomeResult->fetch(PDO::FETCH_OBJ);
            }
        }
    }
    
    public function __destruct() {
        parent::__destruct();
    }
}