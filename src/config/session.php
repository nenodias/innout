<?php

function requiredValidSession($requiresAdmin = false)
{
    $user = $_SESSION["user"];
    if (!isset($user)) {
        redirect("login.php");
        exit();
    } else if($requiresAdmin && !$user->is_admin){
        addErrorMsg("Acesso negado!");
        redirect("day_records.php");
        exit();
    }
}
