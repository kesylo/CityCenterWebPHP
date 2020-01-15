<?php

class Planning{

    private $db;

    /**
     * Planning constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllUsersPlannings($week){
        $this->db->query('SELECT * FROM planning WHERE week = :nextWeek');
        $this->db->bind(':nextWeek', $week);

        $results = $this->db->resultSet();

        return $results;
    }

    public function getUserPlannings($idUser, $week){
        $this->db->query('SELECT * FROM planning WHERE id_user = :id_user and week = :nextWeek');
        $this->db->bind(':id_user', $idUser);
        $this->db->bind(':nextWeek', $week);

        $results = $this->db->resultSet();

        return $results;
    }

    public function addPlanning ($data){
        $this->db->query('INSERT INTO planning (id_user, week, date, startTime, endTime, status, callRedirect)
                             VALUES (:id, :weekday, :workdate, :startTime, :endTime, :requeststatus, :callRedirect )');

        // bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':weekday', $data['week']);
        $this->db->bind(':workdate', $data['date']);
        $this->db->bind(':startTime', $data['startTime']);
        $this->db->bind(':endTime', $data['endTime']);
        $this->db->bind(':requeststatus', $data['status']);
        $this->db->bind(':callRedirect', $data['callRedirect']);

        // run
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function addExtra ($data){
        $this->db->query('INSERT INTO planning (id_user, week, date, startTime, endTime, status, callRedirect)
                             VALUES (:id, :weekday, :workdate, :startTime, :endTime, :requeststatus, :callRedirect )');

        // bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':weekday', $data['week']);
        $this->db->bind(':workdate', $data['date']);
        $this->db->bind(':startTime', $data['startTime']);
        $this->db->bind(':endTime', $data['endTime']);
        $this->db->bind(':requeststatus', $data['status']);
        $this->db->bind(':callRedirect', $data['callRedirect']);

        // run
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getPlanningById ($idPlanning){
        $this->db->query('SELECT * FROM planning WHERE id_planning = :id_planning');
        $this->db->bind(':id_planning', $idPlanning);

        $row = $this->db->single();

        return $row;
    }

    public function getUserById($idUser){
        $this->db->query('SELECT * FROM employees WHERE id = :id_user');
        $this->db->bind(':id_user', $idUser);

        $row = $this->db->single();

        return $row;
    }

    public function getAllActiveUsers(){
        $this->db->query('SELECT * FROM employees WHERE outService IS NULL');
        $results = $this->db->resultSet();

        return $results;
    }

    public function updatePlanning($data){
        $this->db->query('UPDATE planning SET week = :workweek, callRedirect = :callRedirect, date = :workdate, startTime = :startTime, endTime = :endTime, status = :workstatus 
                            WHERE id_planning = :id_planning');

        // bind values
        $this->db->bind(':id_planning', $data['id_planning']);
        $this->db->bind(':workweek', $data['week']);
        $this->db->bind(':workdate', $data['date']);
        $this->db->bind(':startTime', $data['startTime']);
        $this->db->bind(':endTime', $data['endTime']);
        $this->db->bind(':workstatus', $data['status']);
        $this->db->bind(':callRedirect', $data['callRedirect']);

        // run
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deletePlanning($idPlanning){
        $this->db->query('DELETE FROM planning WHERE id_planning = :id_planning');

        // bind values
        $this->db->bind(':id_planning', $idPlanning);

        // run
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function denyPlanning($idPlanning){
        $this->db->query('UPDATE planning SET status = :pStatus WHERE id_planning = :id_planning');

        // bind values
        $this->db->bind(':pStatus', 'Refusé');
        $this->db->bind(':id_planning', $idPlanning);

        // run
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function acceptPlanning($idPlanning){
        $this->db->query('UPDATE planning SET status = :pStatus WHERE id_planning = :id_planning');

        // bind values
        $this->db->bind(':pStatus', 'Accepté');
        $this->db->bind(':id_planning', $idPlanning);

        // run
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

}