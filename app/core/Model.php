<?php

class Model{

    protected $sql = null;

    public function __construct(){
        //construct class
        require_once APP_ROOT . "/core/Sql.php";
        $sql = new Sql();
    }

    public function getJSON($file){
        if(file_exists(APP_ROOT . "/data/json/{$file}.json")){
            return json_decode(file_get_contents(APP_ROOT . "/data/json/{$file}.json"), true);
        }
        return null;
    }

}