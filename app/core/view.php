<?php 

class View{

    public $template = null;
    private $blade = null;

    public function __construct(){
        //construct class
    }

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

    public function set($data = []){
        $xpath = new DOMXPath($this->template);
        foreach($data as $key => $value){
            $nodes = $xpath->query("//ng{$key}");
            $element = $nodes->item(0);
            $frag = $this->template->createDocumentFragment();
            $frag->appendXML($value);
            $element->parentNode->replaceChild($frag, $element);
        }
    }

    public function render(){
        echo $this->template->saveHTML();
    }
}
