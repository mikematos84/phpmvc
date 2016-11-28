<?php 

class Sql{

    public $conn = null;

    public function __construct(){
        global $config;
        require_once APP_ROOT . "/libraries/adodb5/adodb.inc.php";
        $this->conn = NewADOConnection($config->database->driver);
        $this->conn->Connect($config->database->host,$config->database->user,$config->database->password,$config->database->database);
        $this->conn->SetFetchMode(ADODB_FETCH_BOTH);
    }

    public function select($sql, $values = []){
        $stmt = $this->conn->Prepare($sql);
        $row = $this->conn->GetRow($stmt, $values);
        return $row;
    }

    public function selectAll($sql, $values = []){
        $stmt = $this->conn->Prepare($sql);
        $rows =  $this->conn->GetAll($stmt, $values);
        return $rows;
    }

    public function __destruct(){
        $this->conn->Close();
    }
}
