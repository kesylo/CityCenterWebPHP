<?php


class User
{
    private $db;
    /**
     * User constructor.
     */
    public function __construct()
    {
        // init database
        $this->db = new Database();
    }

    public function findUsersByEmail($email){
        $this->db->query('SELECT * FROM employees WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0){
            // there is an email found
            return true;
        }else{
            return false;
        }
    }
}