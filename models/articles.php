<?php
class articles extends dataBase {

    public $article = '';
    public $title = '';
    public $id_agdjjg_user = 0;
    public $idCount = 0;
    public $id = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'ajouter un article
     */
    public function addArticles() {
        // On insère les un nouvel utilisateur
        $queryAddArticles = 'INSERT INTO `'.self::prefix.'articles`(`article`, `title`, `date_articles`, `id_agdjjg_user`) '
                            . 'VALUES (:article, :title, CURDATE(), :id)';
        // On prépare la requête
        $requestAddArticles = $this->db->prepare($queryAddArticles);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestAddArticles->bindValue(':article', $this->article, PDO::PARAM_STR);
        $requestAddArticles->bindValue(':title', $this->title, PDO::PARAM_STR);
        $requestAddArticles->bindValue(':id', $this->id_agdjjg_user, PDO::PARAM_INT);
        // On exécute la requête
        return $requestAddArticles->execute();
    }

    /**
     * Permet de connaitre le nombre d'article écris
     */
    public function countArticle() {
        $queryCountArticle = 'SELECT COUNT(`id`) AS `idCount` FROM `'.self::prefix.'articles` WHERE `id_agdjjg_user` IS NOT NULL';
        // On prépare la requête
        $requestCountArticle = $this->db->prepare($queryCountArticle);
        // Si la requête est exécutée
        if ($requestCountArticle->execute()) {
            return $countArticle = $requestCountArticle->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     * Permet de récupérer les articles pour les afficher sur la page profile
     * @$page -> variable correspondant à la pagination
     */
    public function getArticle($page) {
        $limit = 3;
        $offset = $limit * $page;

        $queryGetArticles = 'SELECT `'.self::prefix.'articles`.`id` AS `id`, `last_name`, `first_name`, `article`,`title`, DATE_FORMAT(`date_article`, "%d/%m/%Y") AS `date_article`, DATE_FORMAT(`updateDate`, "%d/%m/%Y") AS `updateDate` '
                                . 'FROM `'.self::prefix.'articles` '
                           . 'INNER JOIN `'.self::prefix.'user` '
                                . 'ON `'.self::prefix.'user`.`id` = `'.self::prefix.'articles`.`id_agdjjg_user` '
                           . 'LIMIT '.$limit.' OFFSET '.$offset;
        // On prépare la requête
        $requestGetArticles = $this->db->prepare($queryGetArticles);
        // Si la requête est exécutée
        if ($requestGetArticles->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetArticles)) {
                // On retourne le résultat sous forme d'un tableau
                return $requestGetArticlesResult = $requestGetArticles->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet de récupérer un article par son id pour l'afficher aux visiteurs
     */
    public function getArticleById() {
        $queryGetArticle = 'SELECT `'.self::prefix.'articles`.`id` AS `id`, `id_agdjjg_user`, `last_name`, `first_name`, `article`, `title`, DATE_FORMAT(`updateDate`, "%d/%m/%Y") AS `updateDate`, DATE_FORMAT(`date_article`, "%d/%m/%Y") AS `date_article` '
                            . 'FROM `'.self::prefix.'articles` '
                         . 'INNER JOIN `'.self::prefix.'user` '
                                . 'ON `'.self::prefix.'user`.`id` = `'.self::prefix.'articles`.`id_agdjjg_user` '
                         . 'WHERE `'.self::prefix.'articles`.`id` = :id';
        // On prépare la requête
        $requestGetArticle = $this->db->prepare($queryGetArticle);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestGetArticle->bindValue(':id', $this->id, PDO::PARAM_INT);
        // Si la requête est exécutée
        if ($requestGetArticle->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetArticle)) {
                // On retourne le résultat sous forme d'un tableau
                return $requestGetArticleResult = $requestGetArticle->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet de modifier un article
     */
    public function updateArticleById() {
        $queryUpdateArticle = 'UPDATE `'.self::prefix.'Articles` '
                                . 'SET `article`= :article,`title`= :title, `updateDate`= CURDATE()'
                            . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdateArticle = $this->db->prepare($queryUpdateArticle);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestUpdateArticle->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestUpdateArticle->bindValue(':title', $this->title, PDO::PARAM_STR);
        $requestUpdateArticle->bindValue(':article', $this->article, PDO::PARAM_STR);
        // On exécute la requête
        return $requestUpdateArticle->execute();
    }

    /**
     * Permet de supprimer une tâche
     */
    public function deleteArticlesById() {
        // On supprime un article
        $queryDeleteCommentArticles = 'DELETE FROM `'.self::prefix.'Articles` WHERE `id` = :id';
        // On prépare la requête
        $requestDeleteCommentArticles = $this->db->prepare($queryDeleteCommentArticles);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestDeleteCommentArticles->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteCommentArticles->execute();
    }

    public function __destruct() {
        parent::__destruct();
    }
}
