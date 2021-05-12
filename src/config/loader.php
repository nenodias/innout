<?php

function getSessionUser(){
    return isset($_SESSION) && isset($_SESSION["user"]) ? unserialize($_SESSION["user"]) : new User();
}

function putSessionUser($user){
    $_SESSION["user"] = serialize($user);
    return $user;
}

function loadModel($modelName)
{
    try{
        require_once(MODEL_PATH . "/{$modelName}.php");
    }catch(Exception $e){
        error_log("Model $modelName não encontrado");
        error_log($e->getMessage());
    }
}

function loadView($viewName, $params = array())
{
    if (count($params) > 0) {
        foreach ($params as $key => $value) {
            if (strlen($key) > 0) {
                ${$key} = $value;
            }
        }
    }
    require_once(VIEW_PATH . "/{$viewName}.php");
}

function loadTemplateView($viewName, $params = array())
{
    if (count($params) > 0) {
        foreach ($params as $key => $value) {
            if (strlen($key) > 0) {
                ${$key} = $value;
            }
        }
    }

    $user = getSessionUser();
    $workingHours = WorkingHours::loadFromUserAndDate($user->id, date('Y-m-d'));

    $workedIterval = $workingHours->getWorkedInterval()->format("%H:%I:%S");
    $exitTime = $workingHours->getExitTime()->format("H:i:s");
    $activeClock = $workingHours->getActiveClock();



    require_once(TEMPLATE_PATH . "/header.php");
    require_once(TEMPLATE_PATH . "/left.php");
    require_once(VIEW_PATH . "/{$viewName}.php");
    require_once(TEMPLATE_PATH . "/footer.php");
}

function redirect($location)
{
    header("Location: " . PREFIX . "/" . $location);
}
