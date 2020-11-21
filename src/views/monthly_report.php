<main class="content">
    <?php 
        renderTitle(
            "Relatório Mensal",
            "Verificar os apontamentos do mês!",
            "icofont-ui-calendar"
        );
        include(TEMPLATE_PATH . "/message.php");
        print_r($registries);
    ?>
</main>