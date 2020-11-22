<?php
session_start();
requiredValidSession();

$users = User::get();
foreach($users as $user){
    $user->start_date = (new DateTime($user->start_date))->format("d/m/Y");
    $user->end_date = $user->end_date ? (new DateTime($user->start_date))->format("d/m/Y") : $user->end_date;
}

loadTemplateView("users", [
    "users" => $users
]);