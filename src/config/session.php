<?php

function requiredValidSession()
{
    $user = $_SESSION["user"];
    if (!isset($user)) {
        redirect("login.php");
        exit();
    }
}
