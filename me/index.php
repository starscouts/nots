<?php

$title = "Moi";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";
global $key;
global $fullVersion;
global $_name;

$data = data_params()["data"]["params"];
$user = data_user()["data"]["user"];

?>

<div class="container">
    <br>

    <div style="text-align: center;">
        <h3 style="margin-top: 10px;"><?= $_name ?></h3>
    </div>

    <p>Année scolaire <?= $data["schoolYear"] ?></p>

    <?php foreach ($user["establishmentsInfo"] as $establishment): ?>
        <b>
            <?= $establishment["name"] ?><br>
        </b>
        <p>
            <?= $establishment["address"][0] ?>
            <?= trim($establishment["address"][1]) !== "" ? "<br>" . $establishment["address"][1] : "" ?><br>
            <?= $establishment["postalCode"] ?> <?= $establishment["postalLabel"] ?> <?= $establishment["city"] ?><br>
            <?= trim($establishment["province"]) !== "" ? $establishment["province"] . ", " : "" ?><?= $establishment["country"] ?>
            <?= trim($establishment["website"]) !== "" ? "<br><a href='https://$establishment[website]'>" . $establishment["website"] . "</a>" : "" ?>
        </p>
    <?php endforeach; ?>

    <b>
        <?= $_name ?>
    </b>
    <p>
        Classes : <?= implode(", ", $user["studentClass"]) ?><br>
        Groupes : <?= implode(", ", array_map(function ($i) {
            return $i["name"];
        }, $user["groups"])) ?>
    </p>

    <hr>

    <div class="list-group">
        <a href="/absences" class="list-group-item list-group-item-action">
            <img src="/icons/absences.svg" style="margin-right:5px;"><span style="vertical-align: middle;">Absences</span>
        </a>
        <a href="/teachers" class="list-group-item list-group-item-action">
            <img src="/icons/teachers.svg" style="margin-right:5px;"><span style="vertical-align: middle;">Équipe pédagogique</span>
        </a>
        <a href="/holidays" class="list-group-item list-group-item-action">
            <img src="/icons/holidays.svg" style="margin-right:5px;"><span style="vertical-align: middle;">Vacances scolaires</span>
        </a>
        <a href="/custom" class="list-group-item list-group-item-action">
            <img src="/icons/custom.svg" style="margin-right:5px;"><span style="vertical-align: middle;">Personalisation</span>
        </a>
    </div>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
