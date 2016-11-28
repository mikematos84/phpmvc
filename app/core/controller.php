<?php

class Controller{

    public $service = NULL;
    public $model = NULL;
    public $view = NULL;

    public function __construct(){
        //construct class
        $name = str_replace("Controller", "", get_class($this));
        $this->loadModel($name);
    }

    public function loadModel($file){
        if(file_exists(MODELS . "/{$file}.php")){
            require_once MODELS . "/{$file}.php";
            $model = ucfirst($file) . "Model";
            $this->model = new $model();
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
