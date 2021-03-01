<?php
class event_association extends dataBase {

    public $description_event = '';
    public $suggested_event = '';
    public $author_event = '';
    public $path_document_event = '';
    public $id_agdjjg_user = '';
    public $status_event = '';
    public $volunteer_present = '';
    public $id_agdjjg_event_association = 0;
    public $id_agdjjg_status_event = 0;
    public $id = 0;

    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'insérer un évènnement
     */
    public function insertEventAssociation() {
        $queryInsertEvent = 'INSERT INTO `'.self::prefix.'event_association`(`description_event`, `suggested_event`, `date_event`, `path_document_event`, `id_agdjjg_user`, `id_agdjjg_status_event`) '
                               . 'VALUES (:description_event, :suggested_event, :date_event, :path_document_event, :id_agdjjg_user, (SELECT `id` '
                                                                                                                                               . 'FROM `'.self::prefix.'status_event` '
                                                                                                                                       . 'WHERE `status_event` = :status_event))';
        $requestInsertEvent = $this->db->prepare($queryInsertEvent);
        //Avec bindValue on associe le paramètre à la valeur à associer et on indique le type de valeur. PDO:: est une constante
        $requestInsertEvent->bindValue(':description_event', $this->description_event, PDO::PARAM_STR);
        $requestInsertEvent->bindValue(':suggested_event', $this->suggested_event, PDO::PARAM_STR);
        $requestInsertEvent->bindValue(':date_event', $this->date_event, PDO::PARAM_STR);
        $requestInsertEvent->bindValue(':path_document_event', $this->path_document_event, PDO::PARAM_STR);
        $requestInsertEvent->bindValue(':status_event', $this->status_event, PDO::PARAM_STR);
        $requestInsertEvent->bindValue(':id_agdjjg_user', $this->id_agdjjg_user, PDO::PARAM_STR);
        // On éxécute la requête
        return $requestInsertEvent->execute();
    }

    /**
     * Permet d'afficher un évènement
     */
    public function getEvent() {
        $queryGetEvent = 'SELECT `'.self::prefix.'event_association`.`id` AS `id_event_association`, `id_agdjjg_user`, `last_name`, `first_name`, `status_event`, `description_event`, DATE_FORMAT(`date_event`, "%d/%m/%Y") AS `date_event`, `path_document_event`, `suggested_event` '
                               . 'FROM `'.self::prefix.'event_association` '
                       . 'INNER JOIN `'.self::prefix.'status_event` '
                               . 'ON `'.self::prefix.'event_association`.`id_agdjjg_status_event` = `'.self::prefix.'status_event`.`id`'
                       . 'INNER JOIN `'.self::prefix.'user` '
                               . 'ON `'.self::prefix.'user`.`id` = `'.self::prefix.'event_association`.`id_agdjjg_user` ';
        $requestGetEvent = $this->db->prepare($queryGetEvent);
        // Si la méthode est exécutée
        if($requestGetEvent->execute()) {
            // On envoie les résultats
            return $displayEvent = $requestGetEvent->fetchAll(PDO::FETCH_OBJ);
        }
    }

    /**
     * Avec la méthode, on ajoute les bénévoles qui souhaite participer à un évènement
     */
    public function addVolunteerEvent() {
        $queryAddVolunteer = 'INSERT INTO `'.self::prefix.'participation`(`volunteer_present`, `id`, `id_agdjjg_event_association`) '
                                    . 'VALUES (:volunteer_present, :id, :id_agdjjg_event_association)';
        // On prépare la requête
        $requestAddVolunteer = $this->db->prepare($queryAddVolunteer);
        // On associe les valeurs issues du contrôleur aux marqueurs nominatifs de la requête
        $requestAddVolunteer->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestAddVolunteer->bindValue(':id_agdjjg_event_association', $this->id_agdjjg_event_association, PDO::PARAM_INT);
        $requestAddVolunteer->bindValue(':volunteer_present', $this->volunteer_present, PDO::PARAM_STR);
        // On exécute la requête
        return $requestAddVolunteer->execute();
    }

    /**
     * On récupère la liste des évènements en cours et les bénévoles qui y participent
     */
    public function getVolunteerEvent() {
        $queryGetVolunteerEvent = 'SELECT `suggested_event`, GROUP_CONCAT(`volunteer_present` SEPARATOR ", ") AS `volunteer_present` '
                                   . 'FROM `'.self::prefix.'event_association` '
                                        . 'INNER JOIN `'.self::prefix.'participation` '
                                        . 'ON `'.self::prefix.'participation`.`id_agdjjg_event_association` = `'.self::prefix.'event_association`.`id` '
                                   . 'GROUP BY `'.self::prefix.'event_association`.`id`';
        // On prépare la requête
        $requestGetVolunteerEvent = $this->db->prepare($queryGetVolunteerEvent);
        // Si la requête est exécutée
        if ($requestGetVolunteerEvent->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetVolunteerEvent)) {
                // On retourne les résultats
                return $requestGetVolunteerEventResult = $requestGetVolunteerEvent->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet à un utilisateur de supprimer son nom à la liste des volontaires pour une évènement
     */
    public function deleteVolunteerEventById() {
        // La reqête supprime un utilisateur d'une tâche en fonction de son id et de l'id de l'évènement
        $queryDeleteVolunteerEvent = 'DELETE FROM `'.self::prefix.'participation` '
                                        . 'WHERE `id` = :id '
                                          . 'AND `id_agdjjg_event_association` = :id_agdjjg_event_association';
        // On prépare la requête
        $requestDeleteVolunteerEvent = $this->db->prepare($queryDeleteVolunteerEvent);
        // On aasocie les valeurs du contrôleurs aux marqueurs nominatifs de la requête
        $requestDeleteVolunteerEvent->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestDeleteVolunteerEvent->bindValue(':id_agdjjg_event_association', $this->id_agdjjg_event_association, PDO::PARAM_INT);
        // On exécute la requête
        return $requestDeleteVolunteerEvent->execute();
    }

    /**
     * Permet de récupérer un évènement par son id
     */
    public function getEventById() {
        $queryGetEvent = 'SELECT `description_event`, DATE_FORMAT(`date_event`, "%d/%m/%Y") AS `date_event`, `suggested_event`, `status_event`, `path_document_event` '
                                       . 'FROM `'.self::prefix.'event_association` '
                       . 'INNER JOIN `'.self::prefix.'status_event` '
                                       . 'ON `'.self::prefix.'event_association`.`id_agdjjg_status_event` = `'.self::prefix.'status_event`.`id` '
                       . 'WHERE `'.self::prefix.'event_association`.`id` = :id';
        // On prépare la requête
        $requestGetEvent = $this->db->prepare($queryGetEvent);
        // Avec bindValue, on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestGetEvent->bindValue(':id', $this->id, PDO::PARAM_INT);
        // Si la requête est exécutée
        if ($requestGetEvent->execute()) {
            // Et que la requête est un objet
            if (is_object($requestGetEvent)) {
                // On retourne le résultat sous forme d'un tableau
                return $requestGetEventResult = $requestGetEvent->fetchAll(PDO::FETCH_OBJ);
            }
        }
    }

    /**
     * Permet de modifier un évènement
     */
    public function updateEventById() {
        $queryUpdateEvent = 'UPDATE `'.self::prefix.'event_association` '
                                . 'SET `description_event`= :description_event, `date_event`= :date_event, `suggested_event`= :suggested_event, `id_agdjjg_status_event` = (SELECT `id` '
                                                                                                                                                                                                                                 . 'FROM `'.self::prefix.'status_event` '
                                                                                                                                                                                                                         . 'WHERE `status_event` = :status_event) '
                          . 'WHERE `id` = :id';
        // On prépare la requête
        $requestUpdateEvent = $this->db->prepare($queryUpdateEvent);
        // Avec bindValue, on associe le paramètre à la valeur à associer et on indique le type de valeur.
        // PDO:: est une constante
        $requestUpdateEvent->bindValue(':id', $this->id, PDO::PARAM_INT);
        $requestUpdateEvent->bindValue(':description_event', $this->description_event, PDO::PARAM_STR);
        $requestUpdateEvent->bindValue(':date_event', $this->date_event, PDO::PARAM_STR);
        $requestUpdateEvent->bindValue(':suggested_event', $this->suggested_event, PDO::PARAM_STR);
        $requestUpdateEvent->bindValue(':status_event', $this->status_event, PDO::PARAM_STR);
        // On exécute la requête
        return $requestUpdateEvent->execute();
    }
    
    /**
     * permet de mettre à jour un document.
     */
    public function updateFileEventById($path_document_event, $id) {
        // On prépare la requête
        $requestUpdateEvent = $this->db->prepare('UPDATE `'.self::prefix.'event_association` SET `path_document_event`= :path_document_event WHERE `id` = :id');
        $requestUpdateEvent->bindValue(':path_document_event', $path_document_event, PDO::PARAM_STR);
        $requestUpdateEvent->bindValue(':id', $id, PDO::PARAM_INT);
        // On exécute la requête
        return $requestUpdateEvent->execute();
    }

    /**
     * On récupère le chemin du document par son id
     */
    public function getPathDocumentById() {
        $queryGetPath = 'SELECT `path_document_event` FROM `'.self::prefix.'event_association` '
                            . 'WHERE `id` = :id';
        $requestGetPath = $this->db->prepare($queryGetPath);
        $requestGetPath->bindValue(':id', $this->id, PDO::PARAM_INT);
        // Si la méthode est exécutée
        if($requestGetPath->execute()) {
            // On récupère la clé de l'utilisateur
            return $getPath = $requestGetPath->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     * Permet de supprimer un évènnement
     */
    public function deleteEventAssociation() {
        $queryDeleteEvent = 'DELETE FROM `'.self::prefix.'event_association` '
                                    . 'WHERE `id` = :id';
        $requestDeleteEvent = $this->db->prepare($queryDeleteEvent);
        $requestDeleteEvent->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $requestDeleteEvent->execute();
    }

    public function __destruct() {
        parent::__destruct();
    }
}
?>
