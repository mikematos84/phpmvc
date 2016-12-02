<?php 

class HomeController extends Controller{

    public function __construct(){
        parent::__construct();
    }

    public function index($params = []){
        $this->load('home/index')->render([
            'users' => [
                ['name' => 'mike'],
                ['name' => 'billy'],
                ['name' => 'tom'],
                ['name' => 'bryan']
            ]
        ]);
    }

}