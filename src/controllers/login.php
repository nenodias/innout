<?php

loadModel("login");

if (count($_POST) > 0) {
    $login = new Login($_POST);
    try {
        $user = $login->checkLogin();
        redirect("day_records.php");
    } catch (Exception $e) {
        $exception = $e;
    }
}

loadView("login", $_POST + ["exception" => $exception]);
