<?php

function gravatar($email) {
    return "http://www.gravatar.com/avatar.php?gravatar_id=". md5(strtolower(trim($email)));
}

function renderTitle($title, $subtitle, $icon = null){
    require_once(TEMPLATE_PATH . "/title.php");
}