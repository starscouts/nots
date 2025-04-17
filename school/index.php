<?php

$title = "Établissement et compte";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$data = data_params()["data"]["params"];
$user = data_user()["data"]["user"];

global $_userID;
global $_name;

?>

<div class="container"><br><h2><?= $title ?></h2></div>

<div class="container">
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
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
