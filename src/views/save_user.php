<main class="content">
    <?php
    renderTitle(
        "Cadastro de Usuário",
        "Crie e atualize usuários",
        "icofont-user"
    );
    include(TEMPLATE_PATH . "/message.php");
    ?>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <?= renderInput($model, "Nome", "name", "Informe o nome", "col-md-6", null, "text", $errors) ?>
            <?= renderInput($model, "E-mail", "email", "Informe o email", "col-md-6", null, "text", $errors) ?>
        </div>
        <div class="form-row">
            <?= renderInput($model, "Senha", "password", "Informe a senha", "col-md-6", null, "password", $errors) ?>
            <?= renderInput($model, "Confirmação de senha", "confirm_password", "Confirm a senha", "col-md-6", null, "password", $errors) ?>
        </div>
        <div class="form-row">
            <?= renderInput($model, "Data de admissão", "start_date", "", "col-md-6", null, "date", $errors) ?>
            <?= renderInput($model, "Data de desligamento", "end_date", "", "col-md-6", null, "date", $errors) ?>
        </div>
        <div class="form-group form-check col-md-6">
            <input type="checkbox" id="is_admin" name="is_admin" class="form-check-input <?= $errors[$name] ? "is-invalid" : "" ?>" 
                <?= $model->is_admin ? "checked" : "" ?> 
            >
            <label for="is_admin" class="form-check-label">Administrador?</label>
        </div>
        <div>
            <button class="btn btn-primary btn-lg">Salvar</button>
            <a href="users.php" class="btn btn-secondary btn-lg">Cancelar</a>
        </div>
    </form>
</main>