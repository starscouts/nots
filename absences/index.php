<?php

$title = "Absences";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$absences = data_absences();

?>

<div class="container">
    <br><h2><?= $title ?></h2>

    <?php foreach (array_reverse($absences["data"]["absences"]["absences"]) as $absence): ?>
        <div style="margin-top: 5px; padding-top: 5px; padding-bottom: 5px; margin-left: 10px; padding-left: 10px; border-left-style: solid; border-color: #ddd; border-left-width: 5px;">
            <b><?= $absence["reason"] ?></b><?php if (!$absence["justified"]): ?> <span class="btn btn-danger">Non justifiée</span><?php elseif (!$absence["solved"]): ?> <span class="btn btn-warning">Non résolue</span><?php endif; ?><br>
            <?php

            $fmt = new \IntlDateFormatter('fr_FR');
            $fmt->setPattern('d MMM yyyy, H:m');

            $fmt1 = new \IntlDateFormatter('fr_FR');
            $fmt1->setPattern('d MMM yyyy');

            $fmt2 = new \IntlDateFormatter('fr_FR');
            $fmt2->setPattern('H:m');

            ?>
            <?php if ($fmt1->format(new \DateTime(date("c", ($absence["from"] + 3600000) / 1000))) === $fmt1->format(new \DateTime(date("c", ($absence["to"] + 3600000) / 1000)))): ?>
            le <?= $fmt1->format(new \DateTime(date("c", ($absence["from"] + 3600000) / 1000))) ?> de <?= $fmt2->format(new \DateTime(date("c", ($absence["from"] + 3600000) / 1000))) ?> à <?= $fmt2->format(new \DateTime(date("c", ($absence["to"] + 3600000) / 1000))) ?>
            <?php else: ?>
            du <?= $fmt->format(new \DateTime(date("c", ($absence["from"] + 3600000) / 1000))) ?> au <?= $fmt->format(new \DateTime(date("c", ($absence["to"] + 3600000) / 1000))) ?>
            <?php endif; ?><br>
            <?= $absence["hours"] ?> heure<?= $absence["hours"] > 1 ? "s" : "" ?> de cours manquée<?= $absence["hours"] > 1 ? "s" : "" ?>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
