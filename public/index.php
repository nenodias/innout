<h1>OK</h1>
<?php
require_once(dirname(__FILE__, 2) . "/src/config/config.php");
require_once(dirname(__FILE__, 2) . "/src/models/User.php");

$user = new User(["id" => 1, "name" => "Caboclo", "email" => "xubiru@gmail.com"]);

print_r($user);