<?php
session_start();
requiredValidSession();

loadModel("WorkingHours");
$user = $_SESSION["user"];
$wh = WorkingHours::loadFromUserAndDate($user->id, date("Y-m-d"));

echo "<br/> Trabalhadas: ";
print_r($wh->getWorkedInterval()->format('%H:%I:%S'));
echo "<br/> Almoço: ";
print_r($wh->getLunchInterval()->format('%H:%I:%S'));
echo "<br/> Saída: ";
print_r($wh->getExitTime()->format('H:i:s'));