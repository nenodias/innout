<?php
session_start();
requiredValidSession();

loadModel("WorkingHours");

$date = (new DateTime())->getTimestamp();
$today = strftime("%d de %B de %Y", $date);

$user = $_SESSION["user"];
$records = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d', $date));

loadTemplateView("day_records", [ 
    "today" => $today, 
    "records" => $records
]);