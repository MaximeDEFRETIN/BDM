<?php
class avatar extends dataBase {

    public $id = 0;
    public $path_avatar = '';
    public $id_agdjjg_user   = '';
    public $id_agdjjg_avatar  = '';
    
    public function __construct() {
        parent::__construct();
    }
    
    /*
     * Permet d'inserer une image dans la base de donnée
     */
    public function insertAvatar() {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try {
                // On démarre la transaction, toujours mettre la table enfant avant
                // la table parente pour éviter les soucis de suppression
                $this->db->beginTransaction();
                
                $queryUserAvatar = 'INSERT INTO `'.self::prefix.'avatar`(`path_avatar`, `id_agdjjg_user`)'
                                        . 'VALUES (:path_avatar, :id)';
                $requestInsertAvatar = $this->db->prepare($queryUserAvatar);
                $requestInsertAvatar->bindValue(':path_avatar', $this->path_avatar, PDO::PARAM_STR);
                $requestInsertAvatar->bindValue(':id', $this->id, PDO::PARAM_INT);
                $requestInsertAvatar->execute();
                
                $queryIdAvatar = 'UPDATE `'.self::prefix.'user` '
                                    . 'SET `id_agdjjg_avatar` = (SELECT `id` '
                                                                        . 'FROM `'.self::prefix.'avatar` '
                                                                        . 'WHERE `id_agdjjg_user` = :id)'
                        . 'WHERE `id` = :id';
                $requestIdAvatar = $this->db->prepare($queryIdAvatar);
                $requestIdAvatar->bindValue(':id', $this->id, PDO::PARAM_INT);
                $requestIdAvatar->execute();
                
                // commit() permet d'éxécuter les requêtes
                return $this->db->commit();
            } catch (Exception $ex) {
                // Si une erreur survient, on annule les changements.
                $this->db->rollBack();
                echo 'Erreur : ' . $ex->getMessage();
            }
    }
    
    /*
     * Permet de récupérer l'avatar de l'utilisateur
     */
    public function getAvatarById() {
        // Avec la requête, on sélectionne l'avatar d'un utilisateur en fonction de son id
        $queryGetAvatar = 'SELECT `path_avatar` '
                            . 'FROM `'.self::prefix.'avatar` '
                        . 'INNER JOIN `'.self::prefix.'user` '
                            . 'ON `'.self::prefix.'avatar`.`id_agdjjg_user` = `'.self::prefix.'user`.`id` '
                        . 'WHERE `id_agdjjg_user` = :id';
        // On prépare la requête
        $avatar = $this->db->prepare($queryGetAvatar);
        // On attribut l'id de l'utilisateur à idUser
        $avatar->bindValue(':id', $this->id_agdjjg_user, PDO::PARAM_INT);
        // Si la requête est exécuté
        if($avatar->execute()) {
            //On attribut les résultats de la requête à la variable $partitionList
            return $avatarDisplayed = $avatar->fetch(PDO::FETCH_OBJ);
        }
    }
    
    /* 
     * Permet de supprimer un avatar
     */
    public function deleteAvatarById() {
        // On supprime l'avatar de l'utilisateur en fonction de id_agdjjg_user
        $queryDeleteAvatar = 'DELETE FROM `'.self::prefix.'avatar` WHERE `id_agdjjg_user` = :id';
        // On prépare la requête
        $requestDeleteAvatar = $this->db->prepare($queryDeleteAvatar);
        // On attribut l'id de l'utilisateur à id_agdjjg_user
        $requestDeleteAvatar->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On renvoie le résultats
        return $requestDeleteAvatar->execute();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
}
?>