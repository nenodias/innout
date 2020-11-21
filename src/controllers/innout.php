<?php
session_start();
requiredValidSession();

loadModel("WorkingHours");

$user = $_SESSION["user"];
$date = (new DateTime())->getTimestamp();
$records = WorkingHours::loadFromUserAndDate($user->id, $date);

try {
    $currentTime = strftime("%H:%M:%S", time());
    $records->innout($currentTime);
    addSuccessMsg("Ponto inserido com sucesso.");
} catch (AppException $e) {
    addErrorMsg($e->getMessage());
}
redirect("day_records.php");
