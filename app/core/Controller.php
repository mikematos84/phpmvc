<?php

class Controller{

    public $model = NULL;
    public $view = NULL;

    public function __construct(){
        //construct class
        $this->loadModel(str_replace("Controller", "", get_class($this)));
    }

    public function loadModel($file){
        if(file_exists(MODELS . "/{$file}.php")){
            require_once MODELS . "/{$file}.php";
            $class = ucfirst($file) . "Model";
            $this->model = new $class();
        }else{
            require_once APP_ROOT . "/core/Model.php";
            $this->model = new Model();
        }
    }

    public function loadView($file){
        require_once APP_ROOT . "/core/View.php";
        $this->view = new View();
        $this->view->load($file);
    }
}