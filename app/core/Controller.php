<?php

class Controller{

    public $service = NULL;
    public $model = NULL;
    public $view = NULL;

    public function __construct(){
        //construct class
        $target = str_replace("Controller", "", get_class($this));
        $this->loadModel($target);
        $this->loadService($target);
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

    public function loadService($file){
        if(file_exists(SERVICES . "/{$file}.php")){
            require_once SERVICES . "/{$file}.php";
            $service = ucfirst($file) . "Service";
            $this->service = new $service();
        }else{
            require_once APP_ROOT . "/core/Service.php";
            $this->service = new Service();
        }
    }

    public function loadView($file){
        require_once APP_ROOT . "/core/View.php";
        $this->view = new View();
        $this->view->load($file);
    }
}