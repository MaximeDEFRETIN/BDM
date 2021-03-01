<?php
class pages extends dataBase {
    
    public $id = 0;
    public $title = '';
    public $texte_page = '';
    public $date_edited = '';
    public $id_agdjjg_user = 0;
    
    public function addPage() {
        // On insère la descecription d'un livre lu
        $queryAddReaded = 'INSERT INTO `'.self::prefix.'pages`(`title`, `texte_page`, `date_edited`, `id_agdjjg_user`) '
                            . 'VALUES (:title, :texte_page, CURDATE(), (SELECT `id` FROM `'.self::prefix.'user` WHERE `mail` = :mail))';
        $requestAddReaded = $this->db->prepare($queryAddReaded);
        //Avec bindValue, on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestAddReaded->bindValue(':title', $this->title, PDO::PARAM_STR);
        $requestAddReaded->bindValue(':texte_page', $this->texte_page, PDO::PARAM_STR);
        $requestAddReaded->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // On éxécute la requête
        return $requestAddReaded->execute();
    }
    
    /**
     * Permet de connaitre le nombre d'article écris
     */
    public function countPages() {
        // On compte le nombre de description de livre
        $queryCountReaded = 'SELECT COUNT(`id`) AS `id_count` FROM `'.self::prefix.'pages` WHERE `id_agdjjg_user` IS NOT NULL';
        // On prépare la requête
        $requestCountReaded = $this->db->prepare($queryCountReaded);
        // Si la requête est exécutée
        if ($requestCountReaded->execute()) {
            // On retourne le résultat
            return $countReaded = $requestCountReaded->fetch(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * Permet de récupérer toutes les descriptions de livre
     */
    public function getPages($page) {
        $limit = 3;
        $offset = $limit * $page;
    
        $queryGetOpinion = 'SELECT `'.self::prefix.'pages`.`id` AS `id`, `title`, `first_name`, `last_name`, `texte_page`, DATE_FORMAT(`updateDate`, "%d/%m/%Y") AS `updateDate`, `id_agdjjg_user`, DATE_FORMAT(`date_edited`, "%d/%m/%Y") AS `date_edited` '
                                . 'FROM `'.self::prefix.'pages` '
                         . 'INNER JOIN `'.self::prefix.'user` '
                                . 'ON `'.self::prefix.'user`.`id` = `'.self::prefix.'pages`.`id_agdjjg_user` '
                         . 'LIMIT '.$limit.' OFFSET '.$offset;
        // On prépare la requête
        $requestGetOpinion = $this->db->prepare($queryGetOpinion);
        // Si la requête est exécutée
        if ($requestGetOpinion->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetOpinion)) {
                // On retourne le résultat sous forme d'un tableau
                return $requestGetOpinionResult = $requestGetOpinion->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }
    
    /**
     * Permet de sélectionner une description d'un livre en fonction de son id
     */
    public function getPageById() {
        $queryGetReaded = 'SELECT `title`, `first_name`, `last_name`, `texte_page`, DATE_FORMAT(`date_edited`, "%d/%m/%Y") AS `date_edited`, DATE_FORMAT(`updateDate`, "%d/%m/%Y") AS `updateDate` '
                                . 'FROM `'.self::prefix.'pages` '
                         . 'INNER JOIN `'.self::prefix.'user` '
                                . 'ON `'.self::prefix.'user`.`id` = `'.self::prefix.'pages`.`id_agdjjg_user` '
                         . 'WHERE `'.self::prefix.'pages`.`id` = :id';
        // On prépare la requête
        $requestGetReaded = $this->db->prepare($queryGetReaded);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestGetReaded->bindValue(':id', $this->id, PDO::PARAM_INT);
        // Si la requête est exécutée
        if ($requestGetReaded->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetReaded)) {
                // On retourne le résultat sous forme d'un tableau
                return $requestGetReadedResult = $requestGetReaded->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }
    
    /**
     * Permet à l'utilsiateur de modifier la description du livre
     */
    public function updatePage() {
        // On modifie les informations liées au profil d'un utilisateur en fonction de son id
        $queryUpdateReadedBook = 'UPDATE `'.self::prefix.'pages` SET `title` = :title, `texte_page` = :texte_page, `updateDate` = CURDATE() '
                                . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdateProfil = $this->db->prepare($queryUpdateReadedBook);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestUpdateProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestUpdateProfil->bindValue(':title', $this->title, PDO::PARAM_STR);
        $requestUpdateProfil->bindValue(':texte_page', $this->texte_page, PDO::PARAM_STR);
        // On éxécute la requête
        return $requestUpdateProfil->execute();
    }

    /**
     * Permet à un utilisateur de supprimer la description d'un livre
     */
    public function deletePageById() {
        // On prépare la requête
        $requestDeleteProfil = $this->db->prepare('DELETE FROM `'.self::prefix.'pages` WHERE `id` = :id');
        $requestDeleteProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteProfil->execute();
    }
}