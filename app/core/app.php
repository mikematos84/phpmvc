<?php

class App{

    public $url = null;
    public $controller = 'home';
    public $action = 'index';
    public $params = [];
    
    public function __construct(){
        //parse the url
        $this->route();
    }

    public function route(){
        $this->url = $this->parseURL();

        //if has requested view
        if(isset($this->url[0])){
            $this->controller = $this->url[0];
            unset($this->url[0]);
        }

        //if has requested view action
        if(isset($this->url[1])){
            $this->action = $this->url[1];
            unset($this->url[1]);
        }

        //save modifying params
        $this->params = $this->url ? array_values($this->url) : [];

        //load controller
        if(file_exists(CONTROLLERS . '/' . $this->controller . '.php')){
            require_once CONTROLLERS . '/' . $this->controller . '.php';
            $class = ucfirst($this->controller) . 'Controller';
            $controller = new $class();
        }else{
            require_once CONTROLLERS . '/error.php';
            $controller = new ErrorController();
        }

        if(method_exists($controller, $this->action)){
            $controller->{$this->action}($this->params);
        }
    }

    public function parseURL(){
        if(isset($_GET['url'])){
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
