<?php

function requiredValidSession($requiresAdmin = false)
{
    $user = getSessionUser();
    if (!$user->id) {
        redirect("login.php");
        exit();
    } else if ($requiresAdmin && !$user->is_admin) {
        badSession();
    }
}

function badSession()
{
    addErrorMsg("Acesso negado!");
    redirect("day_records.php");
    exit();
}
