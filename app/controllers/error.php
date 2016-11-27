<?php 

class ErrorController extends Controller{

    public $statusCode = 404;

    public function __construct($injects = []){
        parent::__construct($injects);
    }

    public function index($params = []){
        if(isset($params["statusCode"])){
            $this->statusCode = $params["statusCode"];
            unset($params["statusCode"]);
            $params = array_values($params);
        }
        $this->{"error{$this->statusCode}"}($params);
    }

    public function error404($params){
        echo "This is a 404 error";
    }

}