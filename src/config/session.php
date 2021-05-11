<?php

function requiredValidSession($requiresAdmin = false)
{
    if (isset($_SESSION) && isset($_SESSION["user"])) {
        $user = $_SESSION["user"];
        if (!isset($user)) {
            redirect("login.php");
            exit();
        } else if ($requiresAdmin && !$user->is_admin) {
            badSession();
        }
    } else if ($requiresAdmin) {
        badSession();
    }
    $_SESSION["user"] = new User();
}

function badSession()
{
    addErrorMsg("Acesso negado!");
    redirect("day_records.php");
    exit();
}
