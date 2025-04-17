<?php

$title = "Équipe pédagogique";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$timetable = data_timetable_min()["data"]["timetable"];
$teachers = [];

foreach ($timetable as $class) {
    if (!isset($teachers[$class["teacher"]])) $teachers[$class["teacher"]] = [];
    $teachers[$class["teacher"]][] = getSubject($class["subject"]);
    $teachers[$class["teacher"]] = array_unique($teachers[$class["teacher"]]);
}

?>

<div class="container">
    <br>
    <h2><?= $title ?></h2>

    <table>
        <?php foreach ($teachers as $teacher => $subjects): ?>
        <tr>
            <td style="text-align:right;"><b><?= $teacher ?> :&nbsp;</b></td>
            <?php $index = 0; foreach ($subjects as $subject): ?>
            <?= $index !== 0 ? "</tr><td></td>" : "" ?>
            <td><?= $subject ?></td>
            <?php $index++; endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
