<?php 

class View{

    /*
    * Holds unmodified template content
    * @var string
    */

    # Holds raw template content
    # @var string
    public $template = null;
    
    /*
    * filename of the view being requested from the "views" directory 
    * @var string
    */
    public $file = null;

    /*
    * Holds modified template content
    * @var string
    */
    private $output = null;
    

    /*
    * Sets file and loads the template
    * @param string
    */
    public function __construct($file){
        $this->file = $file;
        $this->load();
    }


    /*
    * Loads the requested template
    */
    public function load(){
         if(file_exists(VIEWS . "/{$this->file}.php")){
            ob_start();
            require_once VIEWS . "/{$this->file}.php";
            $this->template = ob_get_clean();
            ob_end_clean();
        }
    }


    /*
    * Uses Twig to parse and modify the template; Renders output
    * @param array
    */
    public function render($data = []){
        if(isset($this->template)){
            $loader = new Twig_Loader_Array(array(
                $this->output => $this->template,
            ));
            $twig = new Twig_Environment($loader);
        }
        echo $twig->render($this->output, $data);
    }
}
