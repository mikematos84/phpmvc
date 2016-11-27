<?php 
//Environment
define("DEVELOPMENT_ENVIRONMENT", true);

//Absolute Urls
define("BASE_URL", str_replace(strrchr($_SERVER["PHP_SELF"], "/"), "", $_SERVER["PHP_SELF"]));
define("SITE_URL", "http" . (($_SERVER["SERVER_PORT"]==443) ? "s://" : "://") . $_SERVER["HTTP_HOST"] . str_replace("/public", "", BASE_URL));

//Absolute Pathing
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(dirname(__FILE__)));
define("APP_ROOT", ROOT . "/app");
define("VIEWS", APP_ROOT . "/views");
define("CONTROLLERS", APP_ROOT . "/controllers");
define("MODELS", APP_ROOT . "/models");

//Check if environment is development and display errors
function setReporting(){
    if(DEVELOPMENT_ENVIRONMENT == true){
        error_reporting(E_ALL);
        ini_set("display_errors","On");
    }else{
        error_reporting(E_ALL);
        ini_set("display_errors","Off");
        ini_set("log_errors", "On");
        ini_set( "error_log", APP_ROOT . DS . "temp" . DS . "logs" . DS . "error.log" );
    }
}

/** Check for Magic Quotes and remove them **/
function stripSlashesDeep($value){
    $value = is_array($value) ? array_map("stripSlashesDeep", $value) : stripslashes($value);
    return $value;
}

/** Remove Magic Qoutes **/
function removeMagicQoutes(){
    if(get_magic_quotes_gpc()){
        $_GET = stripSlashesDeep($_GET);
        $_POST = stripSlashesDeep($_POST);
        $_COOKIE = stripSlashesDeep($_COOKIE);
    }
}

/** Check register globals and remove them **/
function unregisterGlobals(){
    if(ini_get("register_globals")){
        $array = array("_SESSION","_POST","_GET","_COOKIE","_REQUEST","_SERVER","_ENV","_FILES");
        foreach($array as $value){
            foreach($GLOBALS[$value] as $key => $var){
                if($var === $GLOBALS[$key]){
                    unset($GLOBALS[$key]);
                }
            }
        }
    }
}

setReporting();
removeMagicQoutes();
unregisterGlobals();

//load configuration file
$config = null;
if(file_exists(APP_ROOT . "/config/app.json")){
    $config = json_decode(file_get_contents(APP_ROOT . "/config/app.json"));
}

//load required core files
foreach($config->required as $core_file){
    require_once APP_ROOT . DS . "core" . DS . $core_file . ".php";
}

$app = new App();