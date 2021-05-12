<?php
session_start();
requiredValidSession();


$user = getSessionUser();
$date = date("Y-m-d");
$records = WorkingHours::loadFromUserAndDate($user->id, $date);

try {

    $currentTime = strftime("%H:%M:%S", time());
    if(isset($_POST) && isset($_POST["forcedTime"])){
        $currentTime = $_POST["forcedTime"];
    }

    
    $records->innout($currentTime);
    addSuccessMsg("Ponto inserido com sucesso.");
} catch (AppException $e) {
    addErrorMsg($e->getMessage());
}
redirect("day_records.php");
