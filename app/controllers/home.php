<?php 

class HomeController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index($params = []){
        $this->loadView("home/index");
        $this->view->render();
    }

}