<main class="content">
    <?php
    renderTitle(
        "Relatório Mensal",
        "Acompanhe seu saldo de horas",
        "icofont-ui-calendar"
    );
    include(TEMPLATE_PATH . "/message.php");
    ?>
    <div>
        <form class="mb-4" action="#" method="post">
            <div class="input-group">
                <?php if ($user->is_admin) : ?>
                    <select name="user" class="form-control" placeholder="Selecione um usuário...">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?= $user->id ?>" <?= $user->id === $selectedUserId ? "selected" : "" ?>>
                                <?= $user->name ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                <?php endif ?>
                <select name="period" class="form-control" placeholder="Selecione um período...">
                    <?php foreach ($periods as $key => $month) : ?>
                        <option value="<?= $key ?>" <?= $key === $selectedPeriod ? "selected" : "" ?>>
                            <?= $month ?>
                        </option>
                    <?php endforeach ?>
                </select>
                <button class="btn btn-primary ml-2">
                    <i class="icofont-search"></i>
                </button>
            </div>
        </form>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th>Dia</th>
                <th>Entrada 1</th>
                <th>Saída 1</th>
                <th>Entrada 2</th>
                <th>Saída 2</th>
                <th>Saldo</th>
            </thead>
            <tbody>
                <?php foreach ($report as $registry) : ?>
                    <tr>
                        <td><?= formateDateWithLocale($registry->work_date, "%A, %d de %B de %Y") ?></td>
                        <td><?= $registry->time1 ?></td>
                        <td><?= $registry->time2 ?></td>
                        <td><?= $registry->time3 ?></td>
                        <td><?= $registry->time4 ?></td>
                        <td><?= $registry->getBalance() ?></td>
                    </tr>
                <?php endforeach ?>
                <tr class="bg-primary text-white">
                    <td>Horas Trabalhadas</td>
                    <td colspan="3"><?= $sumOfWorkedTime ?></td>
                    <td>Saldo Mensal</td>
                    <td><?= $balance ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</main>