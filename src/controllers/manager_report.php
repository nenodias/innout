<?php
session_start();
requiredValidSession();

$user = $_SESSION["user"];

$activeUsersCount = User::getActiveUsersCount();
$absentUsers = WorkingHours::getAbsentUsers();
$yearAndMonth = (new DateTime())->format("Y-m");
$seconds = WorkingHours::getWorkedTimeInMonth($yearAndMonth);
$hoursInMonth =  explode(":", getTimeStringFromSeconds($seconds))[0];

loadTemplateView("manager_report", [
    "activeUsersCount" => $activeUsersCount,
    "absentUsers" => $absentUsers,
    "hoursInMonth" => $hoursInMonth
]);