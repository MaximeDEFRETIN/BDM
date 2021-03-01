<?php
class task extends dataBase {

    public $suggested_task = '';
    public $description_task = '';
    public $status_task = '';
    public $id_agdjjg_task = '';
    public $id_task = 0;
    public $id = 0;


    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'ajouter une tâche
     */
    public function addTask() {
        // On insère une nouvelle tâche
        $queryAddTask = 'INSERT INTO `'.self::prefix.'task`(`suggested_task`, `description_task`, `date_task`, `id_agdjjg_user`, `id_agdjjg_status_task`) '
                            . 'VALUES (:suggested_task, :description_task,  CURDATE(), :id, (SELECT `id` '
                                                                                                  . 'FROM `'.self::prefix.'status_task` '
                                                                                          . 'WHERE `status_task` = \'Proposée\'))';
        $requestAddTask = $this->db->prepare($queryAddTask);
        //Avec bindValue, on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestAddTask->bindValue(':suggested_task', $this->suggested_task, PDO::PARAM_STR);
        $requestAddTask->bindValue(':description_task', $this->description_task, PDO::PARAM_STR);
        $requestAddTask->bindValue(':id', $this->id_agdjjg_user, PDO::PARAM_INT);
        // On éxécute la requête
        return $requestAddTask->execute();
    }

    /**
     * Permet de récupérer les tâches proposées pour les afficher
     */
    public function getTask() {
        $queryGetTask = 'SELECT `'.self::prefix.'task`.`id` AS `id_task`, `id_agdjjg_user`, `last_name`, `first_name`, `suggested_task`, `description_task`, DATE_FORMAT(`date_task`, "%d/%m/%Y") AS `date_task`, `status_task`
                                FROM `'.self::prefix.'task`
                         INNER JOIN `'.self::prefix.'status_task`
                                   ON `'.self::prefix.'task`.`id_agdjjg_status_task` = `'.self::prefix.'status_task`.`id`
                         INNER JOIN `'.self::prefix.'user`
                                   ON `'.self::prefix.'task`.`id_agdjjg_user` = `'.self::prefix.'user`.`id`';
        // On prépare la requête
        $requestGetTask = $this->db->prepare($queryGetTask);
        // Si la requête est exécutée
        if ($requestGetTask->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetTask)) {
                return $requestGetTaskResult = $requestGetTask->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet à un bénévole de signaler qu'il souhaite faire une tâche
     */
    public function assignVolunteer() {
        // La requête insert un volontairee pour une tâche
        $queryAssignVolunteer = 'INSERT INTO `'.self::prefix.'assigned`(`volunteer`, `id`, `id_agdjjg_task`) '
                                    . 'VALUES (:volunteer, :id, :id_task)';
        // On prépare la requête
        $requestAssignVolunteer = $this->db->prepare($queryAssignVolunteer);
        // On associe les valeurs du contrôleurs aux marqueurs nominatifs de la requête
        $requestAssignVolunteer->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestAssignVolunteer->bindValue(':id_task', $this->id_task, PDO::PARAM_INT);
        $requestAssignVolunteer->bindValue(':volunteer', $this->volunteer, PDO::PARAM_STR);
        // On exécute la requête
        return $requestAssignVolunteer->execute();
    }

    /**
     * Permet de récupérer les bénévoles volontaires pour une tâche
     */
    public function getAssignedVolunteer() {
        // La requête sélectionne les volontaires pour une tâche, la tâche en question, son id et son statut et regroupe les volontaires en fonction de l'id de la tâche
        $queryGetAssignedVolunteer = 'SELECT `suggested_task`, `status_task`, GROUP_CONCAT(`volunteer` SEPARATOR ", ") AS `volunteer` '
                                        . 'FROM `'.self::prefix.'assigned` '
                                   . 'INNER JOIN `'.self::prefix.'task` '
                                        . 'ON `'.self::prefix.'task`.`id` = `'.self::prefix.'assigned`.`id_agdjjg_task` '
                                   . 'INNER JOIN `'.self::prefix.'status_task` '
                                        . 'ON `'.self::prefix.'status_task`.`id` = `'.self::prefix.'task`.`id_agdjjg_status_task` '
                                   . 'GROUP BY `'.self::prefix.'task`.`id`';
        // On prépare la requête
        $requestGetAssignedVolunteer = $this->db->prepare($queryGetAssignedVolunteer);
        // Si la requête est exécutée
        if ($requestGetAssignedVolunteer->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetAssignedVolunteer)) {
                // On retourne le résultat
                return $requestGetAssignedVolunteerResult = $requestGetAssignedVolunteer->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet à un utilisateur de supprimer son nom à la liste des volontaires pour une tâche
     */
    public function deleteVolunteerById() {
        // La reqête supprime un utilisateur d'une tâche en fonction de son id et de l'id de la tâche
        $queryDeleteVolunteer = 'DELETE FROM `'.self::prefix.'assigned` '
                                    . 'WHERE `id` = :id '
                                      . 'AND `id_agdjjg_task` = :id_agdjjg_task';
        // On prépare la requête
        $requestDeleteVolunteer = $this->db->prepare($queryDeleteVolunteer);
        // On associe les valeurs du contrôleurs aux marqueurs nominatifs de la requête
        $requestDeleteVolunteer->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestDeleteVolunteer->bindValue(':id_agdjjg_task', $this->id_agdjjg_task, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteVolunteer->execute();
    }

    /**
     * Permet de récupérer une tâche pour le modifier
     */
    public function getTaskById() {
        // La requête sélectionne une tâche en fonction de son id
        $queryGetTask = 'SELECT `suggested_task`, `description_task` '
                            . 'FROM `'.self::prefix.'task`'
                      . 'WHERE `id` = :id';
        // On prépare la requête
        $requestGetTask = $this->db->prepare($queryGetTask);
        // Avec bindValue, on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestGetTask->bindValue(':id', $this->id, PDO::PARAM_INT);
        // Si la requête est exécutée
        if ($requestGetTask->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetTask)) {
                // On retourne le résultat sous forme d'un tableau
                return $requestGetTaskResult = $requestGetTask->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet de modifier une tâche
     */
    public function updateTaskById() {
        $queryUpdateTask = 'UPDATE `'.self::prefix.'task` '
                                . 'SET `suggested_task`= :suggested_task, `description_task`= :description_task '
                         . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdateTask = $this->db->prepare($queryUpdateTask);
        // Avec bindValue, on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestUpdateTask->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestUpdateTask->bindValue(':description_task', $this->description_task, PDO::PARAM_STR);
        $requestUpdateTask->bindValue(':suggested_task', $this->suggested_task, PDO::PARAM_STR);
        // On exécute la requête
        return $requestUpdateTask->execute();
    }

    /**
     * Permet de mettre à jour le status d'une tâche
     */
    public function updateStatusTaskById() {
        $queryUpdateStatusTask = 'UPDATE `'.self::prefix.'task` '
                                    . 'SET `id_agdjjg_status_task`= (SELECT `id` '
                                                                             . 'FROM `'.self::prefix.'status_task` '
                                                                     . 'WHERE `status_task` = :status_task) '
                               . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdateStatusTask = $this->db->prepare($queryUpdateStatusTask);
        $requestUpdateStatusTask->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestUpdateStatusTask->bindValue(':status_task', $this->status_task, PDO::PARAM_STR);
        // On exécute la requête
        return $requestUpdateStatusTask->execute();
    }

    /**
     * Permet de supprimer une tâche
     */
    public function deleteTaskById() {
        // La requête supprime une tâche en fonction de son id
        $queryDeleteTask = 'DELETE FROM `'.self::prefix.'task` '
                                . 'WHERE `id` = :id';
        // On prépare la requête
        $requestDeleteTask = $this->db->prepare($queryDeleteTask);
        // On associe les valeurs du contrôleurs aux marqueurs nominatifs de la requête
        $requestDeleteTask->bindValue(':id', $this->id, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteTask->execute();
    }

    public function __destruct() {
        parent::__destruct();
    }
}
?>
