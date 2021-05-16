<?php
class user extends dataBase {
    
    public $id = 0;
    public $first_name = '';
    public $last_name = '';
    public $password = '';
    public $mail = '';
    public $status_user = '';
    public $date_signup = '';
    public $pathAvatar = '';
    public $id_agdjjg_status_user = 0;
    public $key_user = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'ajouter un utilisateur
     */
    public function addUser() {
        $requestAddUser = $this->db->prepare('INSERT INTO `'.self::prefix.'user` (`first_name`, `last_name`, `mail`, `date_signup`, `key_user`, `id_agdjjg_status_user`) VALUES (:first_name, :last_name, :mail, CURDATE(), :key_user, (SELECT `id` FROM `'.self::prefix.'status_user` WHERE `status_user` = \'Rédacteur\'))');
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante, 
        $requestAddUser->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $requestAddUser->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $requestAddUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $requestAddUser->bindValue(':key_user', $this->key_user, PDO::PARAM_INT);
        // On éxécute la requête
        return $requestAddUser->execute();
    }
    
    /*
     * Permet d'inserer une image dans la base de donnée
     */
    public function setAvatar($path_avatar, $id) {
        $requestInsertAvatar = $this->db->prepare('UPDATE `'.self::prefix.'user` SET `pathAvatar`='.$path_avatar.'WHERE `id`= '.$id);
        var_dump($requestInsertAvatar);
        $requestInsertAvatar->bindValue($path_avatar, $this->path_avatar, PDO::PARAM_STR);
        $requestInsertAvatar->bindValue($id, $this->id, PDO::PARAM_INT);
        $requestInsertAvatar->execute();
        var_dump($requestInsertAvatar->execute());
    }
    
    /**
     * Permet de savoir si une adresse mail est déjà prise
     */
    public function checkMailUnique() {
        // On prépare la requête
        $checkMailUnique = $this->db->prepare('SELECT COUNT(`mail`) AS countMail FROM `'.self::prefix.'user` WHERE `mail` = :mail');
        // Avec bindValue on associe le paramètre à la valeur à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $checkMailUnique->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // Si la requête est exécutée
        if ($checkMailUnique->execute()) {
            // On envoie le resultat
            $checkMailUniqueResult = $checkMailUnique->fetch(PDO::FETCH_OBJ);
            return $checkMailUniqueResult->countMail;
        } else {
            return false;
        }
    }
    
    /**
     * Permet de récupérer l'adresse mail et le mot de passe de l'utilisateur pour le connecter
     */
    public function getUserByMail() {
        $exists = false;
        // On prépare la requête
        $requestUser = $this->db->prepare('SELECT `first_name`, `last_name`, `mail`, `password`, `'.self::prefix.'user`.`id`, `status_user` FROM `'.self::prefix.'user` INNER JOIN `'.self::prefix.'status_user` ON `'.self::prefix.'status_user`.`id` = `'.self::prefix.'user`.`id_agdjjg_status_user` WHERE `mail` =  :mail');
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // Si la requête est exécutée
        if ($requestUser->execute()) {
            // Et que la requête est un objet
            if (is_object($requestUser)) {
                if($queryUserResult = $requestUser->fetch(PDO::FETCH_OBJ)) {
                    $this->password = $queryUserResult->password;
                    $this->id = $queryUserResult->id;
                    $this->last_name = $queryUserResult->last_name;
                    $this->first_name = $queryUserResult->first_name;
                    $this->mail = $queryUserResult->mail;
                    $this->status_user = $queryUserResult->status_user;
                    return $exists = true;
                }
            }
        }
    }
    
    /*
     * Permet de récupérer l'avatar de l'utilisateur
     */
    public function getAvatarById($id) {
        // On prépare la requête
        $avatar = $this->db->prepare('SELECT `pathAvatar` FROM `'.self::prefix.'user` WHERE `id`='.$id);
        // On attribut l'id de l'utilisateur à idUser
        $avatar->bindValue($id, $this->id, PDO::PARAM_INT);
        // Si la requête est exécuté
        if($avatar->execute()) {
            //On attribut les résultats de la requête à la variable $partitionList
            return $avatarDisplayed = $avatar->fetch(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * Permet à l'utilisateur de récupérer son mot de passe
     */
    public function replacePassword() {
        // On prépare la requête
        $requestReplacePassword = $this->db->prepare('UPDATE `'.self::prefix.'user` SET `password` = :password  WHERE `mail` = :mail');
        //Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        //PDO:: est une constante
        $requestReplacePassword->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $requestReplacePassword->bindValue(':password', $this->password, PDO::PARAM_STR);
        // On éxécute la requête
        $requestReplacePassword->execute();
    }
    
    /**
     * Permet de sélectionner la clé de l'utilisateur via son addresse mail lors de la récupération du mot de passe
     */
    public function getKeyByMail() {
        // On prépare la requête
        $requestGetKey = $this->db->prepare('SELECT `key_user` FROM `'.self::prefix.'user` WHERE `mail` = :mail');
        //Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestGetKey->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // Si la méthode est exécutée
        if($requestGetKey->execute()) {
            // On récupère la clé de l'utilisateur
            return $key = $requestGetKey->fetch(PDO::FETCH_OBJ);
        }
    }
    
    /**
     * Permet de vérifier l'adresse mail de l'utilisateur lors de la récupération du mot de passe
     */
    public function verifyMailByKey() {
        // On prépare la requête
        $requestMail = $this->db->prepare('SELECT `mail` FROM `'.self::prefix.'user` WHERE `key_user` = :key_user');
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestMail->bindValue(':key_user', $this->key_user, PDO::PARAM_STR);
        // On éxécute la requête
        return $requestMail->execute();
    }

    /**
     * Permet à l'utilsiateur de modifier le profil
     */
    public function updateProfile() {
        // On prépare la requête
        $requestUpdateProfil = $this->db->prepare('UPDATE `'.self::prefix.'user` SET `first_name` = :first_name, `last_name` = :last_name, `mail` = :mail WHERE `id` = :id');
        //Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestUpdateProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestUpdateProfil->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $requestUpdateProfil->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $requestUpdateProfil->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        // On éxécute la requête
        return $requestUpdateProfil->execute();
    }
    
    /**
     * Permet à l'utilisateur de modifier son mot de passe, grâce à son id
     */
    public function updatePassword() {
        // On prépare la requête
        $requestUpdatePassword = $this->db->prepare('UPDATE `'.self::prefix.'user` SET `password` = :password WHERE `id` = :id');
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestUpdatePassword->bindValue(':password', $this->password, PDO::PARAM_STR);
        $requestUpdatePassword->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On éxécute la requête
        return $requestUpdatePassword->execute();
    }

    /**
     * Permet à l'utilisateur de modifier son mot de passe, grâçe à son adresse mail
     */
    public function updatePasswordByKey() {
        // On prépare la requête
        $requestUpdatePassword = $this->db->prepare('UPDATE `'.self::prefix.'user` SET `password` = :password WHERE `key_user` = :key_user');
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestUpdatePassword->bindValue(':password', $this->password, PDO::PARAM_STR);
        $requestUpdatePassword->bindValue(':key_user', $this->key_user, PDO::PARAM_INT);
        // On éxécute la requête
        return $requestUpdatePassword->execute();
    }
    
    /**
     * Permet de récupérer les utilisateurs
     */
    public function getUser() {
        // On prépare la requête
        $requestGetUser = $this->db->prepare('SELECT `first_name`, `last_name`, `status_user`, `mail`, `'.self::prefix.'user`.`id` AS `id_user` FROM `'.self::prefix.'user` INNER JOIN `'.self::prefix.'status_user` ON `'.self::prefix.'status_user`.`id` = `'.self::prefix.'user`.`id_agdjjg_status_user`');
        // Si la méthode est exécutée
        if($requestGetUser->execute()) {
            if (is_object($requestGetUser)) {
                // On récupère la clé de l'utilisateur
                return $requestGetUserResult = $requestGetUser->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet de mettre à jour le status d'un utilisateur
     */
    public function updateStatusUserById($tstatus_user, $id) {
        // On prépare la requête
        $requestUpdateStatus = $this->db->prepare('UPDATE `'.self::prefix.'user` SET `id_agdjjg_status_user` = (SELECT `id` FROM `'.self::prefix.'status_user` WHERE `status_user` = :status_user) WHERE `id` = :id');
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestUpdateStatus->bindValue(':status_user', $tstatus_user, PDO::PARAM_STR);
        $requestUpdateStatus->bindValue(':id', $id, PDO::PARAM_INT);
        // On éxécute la requête
        return $requestUpdateStatus->execute();
    }

    /**
     * Permet à un utilisateur de supprimer son profil
     */
    public function deleteProfilById() {
        // On prépare la requête
        $requestDeleteProfil = $this->db->prepare('DELETE FROM `'.self::prefix.'user` WHERE `id` = :id');
        $requestDeleteProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteProfil->execute();
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