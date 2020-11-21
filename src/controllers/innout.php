<?php
session_start();
requiredValidSession();


$user = $_SESSION["user"];
$date = date("Y-m-d");
$records = WorkingHours::loadFromUserAndDate($user->id, $date);

try {

    $currentTime = strftime("%H:%M:%S", time());
    if($_POST["forcedTime"]){
        $currentTime = $_POST["forcedTime"];
    }

    
    $records->innout($currentTime);
    addSuccessMsg("Ponto inserido com sucesso.");
} catch (AppException $e) {
    addErrorMsg($e->getMessage());
}
redirect("day_records.php");
