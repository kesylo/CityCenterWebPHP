<?php

/**
 * PDO database class. to use multiple databases systems
 */

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbName = DB_NAME;

    private $dbHandler;
    private $statement;
    private $error;

    /**
     * Database constructor.
     * this -> to use proprieties within their class
     */
    public function __construct()
    {
        // set DSN
        $dsn = 'mysql:host=' .$this->host . ';dbname=' .$this->dbName;
        $options = array(
            PDO::ATTR_PERSISTENT => true,       // keeps connection alive
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            // more in PDO doc
        );

        // create PDO instance
        try {
            $this->dbHandler = new PDO($dsn, $this->user, $this->pass, $options);

        } catch (PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // method to write queries
    public function query($sql){
        $this->statement = $this->dbHandler->prepare($sql);
    }

    // bind values
    public function bind($param, $value, $type = null){
        if (is_null($type)){
            switch (true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($param, $value, $type);
    }

    // execute prepared statement
    public function execute(){
        return $this->statement->execute();
    }

    // get resultSet as Array of objects
    public function resultSet(){
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    // get resultSet as single object
    public function single(){
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    // get row count
    public function rowCount(){
        return $this->statement->rowCount();
    }


}
