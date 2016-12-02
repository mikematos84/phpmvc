<?php

/**
* Controller is the base controller class that handles requests for the framework. 
* It loads requested views, models, and injects the data from those models into the 
* view to be rendered.  
*/ 

class Controller{

    /**
    * Holds model class
    * @var object $model
    */
    public $model = NULL;


    /**
    * Holds view class
    * @var object $view
    */
    public $view = NULL;
    private $name = NULL;


    /**
    * Triggers loading of model
    * @return void
    */
    public function __construct(){
        $this->name = str_replace("Controller", "", get_class($this));
    }


    public function load($file){
        $this->loadModel($this->name);
        $this->loadView($file);
        return $this->view;
    }

    /**
    * Instantiates Model Class
    * @return void
    */
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


    /**
    * Instantiates View Class
    * @return void
    */
    public function loadView($file){
        require_once APP_ROOT . "/core/View.php";
        $this->view = new View($file);
    }
}
