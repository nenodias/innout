<?php
session_start();
require_once(dirname(__FILE__, 2) . "/src/config/config.php");

$uri = urldecode(
    parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH)
);
$count = 0;
$pos = strpos($uri, PREFIX);
if($pos !== false){
    $pos = $pos + strlen(PREFIX);
    $uri = substr($uri, $pos);
}

if($uri === "/" || $uri === "" || $uri === "/index.php")
{
    $uri = "/day_records.php";
}

require_once(CONTROLLER_PATH . "/{$uri}");