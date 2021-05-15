<?php
class comment_article extends dataBase {

    public $comment_article = '';
    public $date_comment = '';
    public $author = '';
    public $id_agdjjg_article = 0;
    public $id = 0;
    public $id_answer = 0;
    public $answer = 0;
    public $valided = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'insérer le commentaire d'un visiteur
     */
    public function insertComment() {
        $queryInsertComment = 'INSERT INTO `'.self::prefix.'article_comment_visitor`(`comment_article`, `date_comment`, `author`, `id_agdjjg_article`, `id_answer_comment`, `validated`) '
                                . 'VALUES (:comment_article, CURRENT_DATE(), :author, :id_agdjjg_article, :id_answer_comment, 0)';
        // On prépare la requête
        $requestInsertComment = $this->db->prepare($queryInsertComment);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestInsertComment->bindValue(':comment_article', $this->comment_article, PDO::PARAM_STR);
        $requestInsertComment->bindValue(':author', $this->author, PDO::PARAM_STR);
        $requestInsertComment->bindValue(':id_agdjjg_article', $this->id_agdjjg_article, PDO::PARAM_INT);
        $requestInsertComment->bindValue(':id_answer_comment', $this->id_answer_comment, PDO::PARAM_INT);
        // On exécute la requête
        return $requestInsertComment->execute();
    }

    /**
     * Permet de récupérer les commentaires d'un article
     */
    public function getCommentArticleById($valid, $article) {
        // On prépare la requête
        $requestGetComment = $this->db->prepare('SELECT `comment_article`, `'.self::prefix.'articles`.`title` AS `title_article`, DATE_FORMAT(`date_comment`, "%d/%m/%Y") AS `date_comment`, `author`, `'.self::prefix.'article_comment_visitor`.`id` AS `id`, `id_answer_comment` FROM `'.self::prefix.'article_comment_visitor` INNER JOIN `'.self::prefix.'articles` ON `'.self::prefix.'articles`.`id` = `'.self::prefix.'article_comment_visitor`.`id_agdjjg_article` WHERE `id_agdjjg_article` = '.$article.'  AND `validated` = '.$valid);
        $requestGetComment->bindValue($article, $this->id_agdjjg_article, PDO::PARAM_INT);
        // Si la requête est exécutée
        if ($requestGetComment->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetComment)) {
                return $requestGetCommentResult = $requestGetComment->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }
    
    /**
     * Permet de valider un commentaire
     */
    public function validationComment($number) {
        $queryValidation = 'UPDATE `'.self::prefix.'article_comment_visitor` '
                                . 'SET `validated`= '.$number.', `id_agdjjg_article`= :id_agdjjg_article '
                         . 'WHERE `id` = :id';
        $requestValidation = $this->db->prepare($queryValidation);
        $requestValidation->bindValue(':id_agdjjg_article', $this->id_agdjjg_article, PDO::PARAM_INT);
        $requestValidation->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $requestValidation->execute();
    }
    
    /**
     * Permet de supprimer un commentaire
     */
    public function deleteComment() {
        $queryDeleteComment = 'DELETE FROM `'.self::prefix.'article_comment_visitor` '
                                   . 'WHERE `id` = :id';
        $requestDeleteComment = $this->db->prepare($queryDeleteComment);
        $requestDeleteComment->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $requestDeleteComment->execute();
    }

    public function __destruct() {
        parent::__destruct();
    }
}