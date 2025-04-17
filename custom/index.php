<?php

$title = "Personalisation";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

global $_userID;

$marks = data_marks()["data"]["marks"]["subjects"];
$timetable = data_timetable()["data"]["timetable"];
$subjects = [];

foreach ($timetable as $class) {
    $subjects[md5($class["subject"])] = $class["subject"];
}

foreach ($marks as $subject) {
    if (!in_array($subject, array_values($subjects))) {
        $subjects[md5($subject["name"])] = $subject["name"];
    }
}

$data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $_userID . ".json"), true);
$name = data_user()["data"]["user"]["name"];

?>

<div class="container">
    <br><h2><?= $title ?></h2>

    <form action="/custom/save" method="post">
        <h4>Nom d'usage</h4>
        <p>Changez le nom qui est affiché à travers Nots pour celui de votre choix, ce paramètre s'appliquera sur tous les appareils connectés au même compte Nots. Laissez le champ vide pour afficher le nom tel qu'il est inscrit dans Pronote.</p>

        <div style="display:grid;grid-template-columns: 1fr 1fr;grid-column-gap: 10px;">
            <input class="form-control" disabled value="<?= $name ?>">
            <input class="form-control" name="student" placeholder="Nom à afficher" <?= isset($data["student"]) && $data["student"] !== $name ? 'value="' . $data["student"] . '"' : '' ?>>
        </div>
        <br>

        <h4>Nom des matières</h4>
        <p>Changez le nom des matières affichées dans Nots, ce paramètre s'appliquera sur tous les appareils connectés au même compte Nots. Laissez le champ vide pour afficher le nom tel qu'il est inscrit dans Pronote.</p>

        <?php foreach ($subjects as $id => $subject): ?>
            <div style="margin-bottom:10px;display:grid;grid-template-columns: 1fr 1fr;grid-column-gap: 10px;">
                <input class="form-control" disabled value="<?= $subject ?>">
                <input class="form-control" name="subject[<?= $id ?>]" placeholder="Nom à afficher" <?= isset($data["subjects"][$id]) && $data["subjects"][$id] !== $subject ? 'value="' . $data["subjects"][$id] . '"' : '' ?>>
            </div>
        <?php endforeach; ?>

        <p>
            <input type="submit" value="Enregistrer" class="btn btn-primary">
        </p>
    </form>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
