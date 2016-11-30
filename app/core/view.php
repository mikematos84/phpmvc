<?php 

class View{

    public $template = null;
    public $renderer = null;
    public $file = null;
    
    public function __construct(){
        //construct class
    }

    /*
    public function load($file){
        if(file_exists(VIEWS . "/{$file}.php")){
            ob_start();
            require_once VIEWS . "/{$file}.php";
            $output = ob_get_clean();
            $this->template = new DOMDocument();
            libxml_use_internal_errors(true);
            $this->template->loadHTML($output);
            libxml_use_internal_errors(false);
            ob_end_clean();
        }
    }
    */

    public function load($file){
        $this->file = $file;
         if(file_exists(VIEWS . "/{$file}.php")){
            ob_start();
            require_once VIEWS . "/{$file}.php";
            $this->template = ob_get_clean();
            ob_end_clean();
        }
    }

    /*
    public function set($key, $value){
        $count = (int)preg_match_all("/" . $key . "/", $this->template, $this->output);
        do{
            if(isset($index) == false){
                $index = 0;
            }

            $this->template = preg_replace("/" . $key . "/", "{$value}", $this->template, 1, $count);
            $index++;
        }while($count);
    }

    public function render(){
        echo $this->template->saveHTML();
    }
    */

    public function render(){
        //echo $this->template;
        $loader = new Twig_Loader_Array(array(
            $this->file => $this->template,
        ));
        $twig = new Twig_Environment($loader);
        echo $twig->render($this->file, ["users" => [
            ["name" => "mike"],
            ["name" => "billy"],
            ["name" => "tom"],
            ["name" => "bryan"]
        ]]);
    }
}
