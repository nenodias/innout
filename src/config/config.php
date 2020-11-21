<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_TIME, "pt_BR", "pt_BR.utf-8", "portuguese");

define("PREFIX", "/innout");

//Constantes Gerais
define("DAILY_TIME", 60 * 60 * 8);

//Pastas
define("MODEL_PATH", realpath(dirname(__FILE__) . "/../models"));
define("VIEW_PATH", realpath(dirname(__FILE__) . "/../views"));
define("TEMPLATE_PATH", realpath(dirname(__FILE__) . "/../views/template"));
define("CONTROLLER_PATH", realpath(dirname(__FILE__) . "/../controllers"));
define("EXCEPTION_PATH", realpath(dirname(__FILE__) . "/../exceptions"));


//Arquivos
require_once(realpath(dirname(__FILE__) . "/database.php"));
require_once(realpath(dirname(__FILE__) . "/loader.php"));
require_once(realpath(dirname(__FILE__) . "/session.php"));
require_once(realpath(dirname(__FILE__) . "/date_utils.php"));
require_once(realpath(dirname(__FILE__) . "/utils.php"));
require_once(realpath(dirname(__FILE__) . "/view.php"));
require_once(realpath(MODEL_PATH . "/Model.php"));
require_once(realpath(MODEL_PATH . "/User.php"));
require_once(realpath(MODEL_PATH . "/WorkingHours.php"));
require_once(realpath(EXCEPTION_PATH . "/AppException.php"));
require_once(realpath(EXCEPTION_PATH . "/ValidationException.php"));
