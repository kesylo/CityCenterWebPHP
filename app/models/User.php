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

    /*public function findUsersByEmail($email){
        $this->db->query('SELECT * FROM employees WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0){
            // there is an email found
            return true;
        }else{
            return false;
        }
    }*/

    public function findUsersByPseudo($pseudo){
        $this->db->query('SELECT * FROM employees WHERE pseudo = :pseudo');
        $this->db->bind(':pseudo', $pseudo);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0){
            // there is an email found
            return true;
        }else{
            return false;
        }
    }

    /*public function login($email, $password){
        $this->db->query('SELECT * FROM employees WHERE email = :email and password = :password');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0){
            // user found
            return $row;
        }else{
            return false;
        }
    }*/

    public function login($pseudo, $password){
        $this->db->query('SELECT * FROM employees WHERE pseudo = :pseudo and password = :password');
        $this->db->bind(':pseudo', $pseudo);
        $this->db->bind(':password', $password);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0){
            // user found
            return $row;
        }else{
            return false;
        }
    }
}