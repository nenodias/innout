<?php
session_start();
requiredValidSession(true);

$exception = null;
if(isset($_GET["delete"])){
    try{
        $id = $_GET["delete"];
        User::deleteById($id);
        addSuccessMsg("Usuário {$id} excluído com sucesso!");
    }catch(Exception $e){
        if(stripos($e->getMessage(), "FOREIGN KEY")){
            addErrorMsg("Não possível excluir o usuário, o mesmo possui registros de ponto.");
        }else {
            $exception = $e;
        }
    }
}

$users = User::get();
foreach($users as $user){
    $user->start_date = (new DateTime($user->start_date))->format("d/m/Y");
    $user->end_date = $user->end_date ? (new DateTime($user->end_date))->format("d/m/Y") : $user->end_date;
}

loadTemplateView("users", [
    "users" => $users,
    "exception" => $exception
]);