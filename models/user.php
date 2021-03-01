<?php
class user extends dataBase {
    
    public $id = 0;
    public $first_name = '';
    public $last_name = '';
    public $password = '';
    public $mail = '';
    public $status_user = '';
    public $date_signup = '';
    public $id_agdjjg_status_user = '';
    public $id_agdjjg_avatar  = '';
    public $key_user = '';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'ajouter un utilisateur
     */
    public function addUser() {
        // On insère les un nouvel utilisateur
        $queryAddUser = 'INSERT INTO `'.self::prefix.'user` (`first_name`, `last_name`, `mail`, `date_signup`, `key_user`, `id_agdjjg_status_user`) '
                            . 'VALUES (:first_name, :last_name, :mail, CURDATE(), :key_user, (SELECT `id` '
                                                                                    . 'FROM `'.self::prefix.'status_user` '
                                                                               . 'WHERE `status_user` = \'Rédacteur\'))';
        $requestAddUser = $this->db->prepare($queryAddUser);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante, 
        $requestAddUser->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $requestAddUser->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $requestAddUser->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $requestAddUser->bindValue(':key_user', $this->key_user, PDO::PARAM_INT);
        // On éxécute la requête
        return $requestAddUser->execute();
    }
    
    /**
     * Permet de savoir si une adresse mail est déjà prise
     */
    public function checkMailUnique() {
        // On compte le nombre de fois que le mail a été trouvé
        $queryCheckMail = 'SELECT COUNT(`mail`) AS countMail '
                          . 'FROM `'.self::prefix.'user`'
                          . 'WHERE `mail` = :mail';
        // On prépare la requête
        $checkMailUnique = $this->db->prepare($queryCheckMail);
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
        $queryUser = 'SELECT `first_name`, `last_name`, `mail`, `password`, `'.self::prefix.'user`.`id`, `status_user`
                        FROM `'.self::prefix.'user`
                      INNER JOIN `'.self::prefix.'status_user`
                        ON `'.self::prefix.'status_user`.`id` = `'.self::prefix.'user`.`id_agdjjg_status_user`
                      WHERE `mail` =  :mail';
        // On prépare la requête
        $requestUser = $this->db->prepare($queryUser);
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
    
    /**
     * Permet à l'utilisateur de récupérer son mot de passe
     */
    public function replacePassword() {
        // La requête modifie le mot de passe en fonction de l'adresse mail
        $query = 'UPDATE `'.self::prefix.'user` SET `password` = :password  WHERE `mail` = :mail';
        // On prépare la requête
        $requestReplacePassword = $this->db->prepare($query);
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
        $queryMail = 'SELECT `key_user` FROM `'.self::prefix.'user` WHERE `mail` = :mail';
        // On prépare la requête
        $requestGetKey = $this->db->prepare($queryMail);
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
        // On sélectionne l'adresse mail en fonction de la clé de l'utilisateur
        $queryKey = 'SELECT `mail` FROM `'.self::prefix.'user` WHERE `key_user` = :key_user';
        // On prépare la requête
        $requestMail = $this->db->prepare($queryKey);
        // Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestMail->bindValue(':key_user', $this->key_user, PDO::PARAM_STR);
        // On éxécute la requête
        return $requestMail->execute();
    }

    /**
     * Permet à l'utilsiateur de modifier le profil
     */
    public function updateProfile() {
        // On modifie les informations liées au profil d'un utilisateur en fonction de son id
        $queryUpdateProfile = 'UPDATE `'.self::prefix.'user` SET `first_name` = :first_name, `last_name` = :last_name, `mail` = :mail '
                                . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdateProfil = $this->db->prepare($queryUpdateProfile);
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
        // On modifie le mot de passe d'un utilisateur en fonction de son id
        $queryUpdatePassword = 'UPDATE `'.self::prefix.'user` SET `password` = :password '
                                . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdatePassword = $this->db->prepare($queryUpdatePassword);
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
        // On modifie le mot de passe d'un utilisateur en fonction de son id
        $queryUpdatePassword = 'UPDATE `'.self::prefix.'user` SET `password` = :password '
                                . 'WHERE `key_user` = :key_user';
        // On prépare la requête
        $requestUpdatePassword = $this->db->prepare($queryUpdatePassword);
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
        // On supprime l'utilisateur en fonction de son id
        $queryDeleteProfil = 'DELETE FROM `'.self::prefix.'user` WHERE `id` = :id';
        // On prépare la requête
        $requestDeleteProfil = $this->db->prepare($queryDeleteProfil);
        $requestDeleteProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteProfil->execute();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
}
?>