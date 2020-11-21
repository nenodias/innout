<?php
session_start();
requiredValidSession();

loadModel("WorkingHours");
$user = $_SESSION["user"];
$wh = WorkingHours::loadFromUserAndDate($user->id, date("Y-m-d"));

print_r($wh->getWorkedInterval()->format('%H:%I:%S'));