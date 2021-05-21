<?php
class categorie extends dataBase {
    public $id = 0;
    public $nom = '';
    public $description = '';
    public $dateCreated = '';
    public $maj = '';
    public $id_agdjjg_articles = 0;
    public $idCategorie = 0;


    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet de récupérer les catégories
     */
    public function getCategorie() {
        // On prépare la requête
        $requestGetCategorieResult = $this->db->prepare('SELECT DISTINCT `'.self::prefix.'categorie`.`id` AS `idCategorie`, `nom`, `description`, DATE_FORMAT(`'.self::prefix.'association_articles-categories`.`dateCreated`, "%d/%m/%Y") AS `dateCreated`, COUNT(`'.self::prefix.'association_articles-categories`.`id_'.self::prefix.'articles` = `'.self::prefix.'articles`.`id`) AS `countNbArtCat` FROM `'.self::prefix.'categorie` INNER JOIN `'.self::prefix.'association_articles-categories` ON `'.self::prefix.'association_articles-categories`.`id_'.self::prefix.'categories` = `'.self::prefix.'categorie`.`id` INNER JOIN `'.self::prefix.'articles` ON `'.self::prefix.'association_articles-categories`.`id_'.self::prefix.'articles` = `'.self::prefix.'articles`.`id` GROUP BY `idCategorie`');
        // Si la requête est exécutée
        if ($requestGetCategorieResult->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetCategorieResult)) {
                return $requestGetCategorieResult = $requestGetCategorieResult->fetchAll(PDO::FETCH_OBJ);
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