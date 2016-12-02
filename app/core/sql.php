<?php 

class Sql{

    /*
    * ADOdb connection
    * @var object
    */
    public $conn = null;


    /*
    * Triggers connection
    */
    public function __construct(){
        $this->connect();
    }


    /*
    * Initiates database connection using data from app.json config file
    */
    private function connect(){
        global $config;
        $this->conn = NewADOConnection($config->database->driver);
        $this->conn->Connect($config->database->host,$config->database->user,$config->database->password,$config->database->database);
        $this->conn->SetFetchMode(ADODB_FETCH_BOTH);
    }


    /*
    * Re-establish connection 
    */
    public function __wakeup(){
        $this->connect();
    }


    /*
    * Commit pending data 
    */
    public function __sleep(){
        return array($config->database->host,$config->database->user,$config->database->password,$config->database->database);
    }


    /*
    * Close database connection on destruction of class
    */
    public function __destruct(){
        $this->conn->Close();
    }


}
