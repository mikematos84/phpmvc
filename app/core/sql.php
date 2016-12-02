<?php

/**
* This class uses the ADOdb Abstract layer in order to connect to a database. 
* I chose to go with this class due to its robust functionality and ability 
* to easily adapt to a wide array of database styles and not jut be solely dependent
* on MySQL
*/ 

class Sql{

    /**
    * Holds connection
    * @var object
    */
    public $conn = null;


    /**
    * Triggers connection
    * @return void
    */
    public function __construct(){
        $this->connect();
    }


    /**
    * Initiates database connection using data from app.json config file
    * @return void
    */
    private function connect(){
        global $config;
        $this->conn = NewADOConnection($config->database->driver);
        $this->conn->Connect($config->database->host,$config->database->user,$config->database->password,$config->database->database);
        $this->conn->SetFetchMode(ADODB_FETCH_BOTH);
    }


    /**
    * Re-establish connection
    * @return void
    */
    public function __wakeup(){
        $this->connect();
    }


    /**
    * Commit pending data 
    * @return void
    */
    public function __sleep(){
        return array($config->database->host,$config->database->user,$config->database->password,$config->database->database);
    }


    /**
    * Close database connection on destruction of class
    * @return void
    */
    public function __destruct(){
        $this->conn->Close();
    }


}
