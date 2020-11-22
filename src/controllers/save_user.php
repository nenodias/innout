<?php
session_start();
requiredValidSession();

$exception = null;

$model = null;
if (count($_POST) > 0) {
    try {
        $model = new User($_POST);
        $model->insert();
        $model = null;
        addSuccessMsg("Usuário cadastrado com sucesso!");
        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;
    }
}

if(!$model){
    $model = new User();
}

loadTemplateView("save_user", $_POST + [
    "exception" => $exception,
    "model" => $model
]);
