<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "portuguese");

define("PREFIX", "/innout");

//Constantes Gerais
define("DAILY_TIME", 60 * 60 * 8);
$directory = dirname(__FILE__);
define("APP_PATH", $directory);

//Pastas
define("MODEL_PATH", realpath(APP_PATH . "/../models"));
define("VIEW_PATH", realpath(APP_PATH . "/../views"));
define("TEMPLATE_PATH", realpath(APP_PATH . "/../views/template"));
define("CONTROLLER_PATH", realpath(APP_PATH . "/../controllers"));
define("EXCEPTION_PATH", realpath(APP_PATH . "/../exceptions"));


//Arquivos
require_once(realpath(APP_PATH . "/database.php"));
require_once(realpath(APP_PATH . "/loader.php"));
require_once(realpath(APP_PATH . "/session.php"));
require_once(realpath(APP_PATH . "/date_utils.php"));
require_once(realpath(APP_PATH . "/utils.php"));
require_once(realpath(APP_PATH . "/view.php"));
require_once(realpath(MODEL_PATH . "/Model.php"));
require_once(realpath(MODEL_PATH . "/User.php"));
require_once(realpath(MODEL_PATH . "/WorkingHours.php"));
require_once(realpath(EXCEPTION_PATH . "/AppException.php"));
require_once(realpath(EXCEPTION_PATH . "/ValidationException.php"));
