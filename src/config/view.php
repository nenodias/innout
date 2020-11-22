<?php

function gravatar($email)
{
    return "http://www.gravatar.com/avatar.php?gravatar_id=" . md5(strtolower(trim($email)));
}

function renderTitle($title, $subtitle, $icon = null)
{
    require_once(TEMPLATE_PATH . "/title.php");
}

function renderInput($_model, $_label, $_name, $_placeHolder, $_css, $_cssInput, $_type, $errors)
{
?>
    <div class="form-group <?= $_css ?>">
        <label for="<?= $_name ?>"><?= $_label ?></label>
        <input type="<?= $_type ?>" id="<?= $_name ?>" name="<?= $_name ?>" placeholder="<?= $_placeHolder ?>" class="<?= $_cssInput ? $_cssInput : "form-control" ?> <?= $errors[$_name] ? "is-invalid" : "" ?>" 
        <?php if ($_type === "text" || $_type === "date" || $_type === "time") : ?> 
            value="<?= $_model->$_name ? $_model->$_name : "" ?>" 
        <?php endif ?>
        <?php if ($_type === "checkbox") : ?> 
            <?= $_model->$_name ? "checked" : "" ?> 
        <?php endif ?>
        <?php if ($_type === "radio" || $_type === "select") : ?> 
            <?= $_model->$_name ? "selected" : "" ?> 
        <?php endif ?>
        >
        <div class="invalid-feedback">
            <?= $errors[$_name] ?>
        </div>
    </div>
<?php
}
