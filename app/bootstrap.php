<?php 
/* Sessions */
session_start();

/* Environment */
define("DEVELOPMENT_ENVIRONMENT", true);

/* Absolute Urls */
define("BASE_URL", str_replace(strrchr($_SERVER["PHP_SELF"], "/"), "", $_SERVER["PHP_SELF"]));
define("SITE_URL", "http" . (($_SERVER["SERVER_PORT"]==443) ? "s://" : "://") . $_SERVER["HTTP_HOST"] . str_replace("/public", "", BASE_URL));

/* Absolute Patching */
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(dirname(__FILE__)));
define("APP_ROOT", ROOT . "/app");
define("VIEWS", APP_ROOT . "/views");
define("CONTROLLERS", APP_ROOT . "/controllers");
define("MODELS", APP_ROOT . "/models");

/* Compose Autoload */
require_once APP_ROOT . "/vendor/autoload.php";

/* Load configuration file */
$config = null;
if(file_exists(APP_ROOT . "/config/app.json")){
    $config = json_decode(file_get_contents(APP_ROOT . "/config/app.json"));
}

/* Load required core files */
foreach($config->require as $core_file){
    require_once APP_ROOT . DS . "core" . DS . $core_file . ".php";
}

/* Start app */
$app = new App();
