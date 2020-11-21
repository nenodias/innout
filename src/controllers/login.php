<?php
loadModel("login");
session_start();

if (count($_POST) > 0) {
    $login = new Login($_POST);
    try {
        $user = $login->checkLogin();
        $_SESSION["user"] = $user;
        redirect("day_records.php");
    } catch (Exception $e) {
        $exception = $e;
    }
}

loadView("login", $_POST + ["exception" => $exception]);
