<?php
session_start();
requiredValidSession(true);

$exception = null;

$model = null;
if (count($_POST) === 0 && isset($_GET["update"])) {
    $model = User::getOne(["id" => $_GET["update"]]);
} else if (count($_POST) > 0) {
    try {
        $model = new User($_POST);
        if($model->id){
            $model->update();
            addSuccessMsg("Usuário atualizado com sucesso!");
        }else {
            $model->insert();
            addSuccessMsg("Usuário cadastrado com sucesso!");
        }
        redirect("users.php");
        exit();
        $model = null;
        $_POST = [];
    } catch (Exception $e) {
        $exception = $e;
    }
}

if (!$model) {
    $model = new User();
}

loadTemplateView("save_user", $_POST + [
    "exception" => $exception,
    "model" => $model,
    "id" => $model->id
]);
