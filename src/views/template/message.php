<?php

$errors = [];

if ($exception) {
    $message = [
        "type" => "error",
        "message" => $exception->getMessage()
    ];

    if(get_class($exception) === "ValidationException"){
        $errors = $exception->getErrors();
    }
}

$alertType = "";

if ($message &&  $message["type"] === "error") {
    $alertType = "danger";
} else if ($message &&  $message["type"] === "warning") {
    $alertType = "warning";
} else if ($message &&  $message["type"] === "info") {
    $alertType = "info";
} else {
    $alertType = "success";
}

?>
<?php if ($message) { ?>

    <div class="my-3 alert alert-<?= $alertType ?>" role="alert">
        <?= $message["message"] ?>
    </div>

<?php } ?>