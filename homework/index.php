<?php

$title = "Cours";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$homeworks = data_homeworks()["data"]["homeworks"];

?>

<div class="container">
    <br>
    <h2>Cours</h2>

    <div class="dropdown" style="margin-bottom: 10px;">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Devoirs
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/timetable">Emploi du temps</a></li>
            <li><a class="dropdown-item" href="/content">Contenus</a></li>
            <li><a class="dropdown-item disabled" href="#">Devoirs</a></li>
            <li><a class="dropdown-item" href="/files">Fichiers</a></li>
        </ul>
    </div>

    <?php foreach ($homeworks as $homework): if (($homework["for"] + 7200000) / 1000 >= time()): ?>
    <div style="margin-top: 5px; padding-top: 5px; margin-left: 10px; padding-left: 10px; border-left-style: solid; border-color: <?= $homework["color"] ?>; border-left-width: 5px;margin-bottom:10px;">
        <b><?= getSubject($homework["subject"]) ?></b> · pour le <?php

        $fmt = new \IntlDateFormatter('fr_FR');
        $fmt->setPattern('d MMM yyyy');
        echo $fmt->format(new \DateTime(date("c", ($homework["for"] + 7200000) / 1000)));

        $remaining = ceil(((($homework["for"] + 7200000) / 1000) - time()) / 86400);
        $total = ceil(((($homework["for"] + 7200000) / 1000) - (($homework["givenAt"] + 7200000) / 1000)) / 86400);

        ?> · reste <?= $remaining ?>/<?= $total ?> jour<?= $remaining > 1 ? "s" : "" ?>
        <?= $homework["htmlDescription"] ?? str_replace("\n", "<br>", strip_tags($homework["description"])) ?>
        <div style="margin-top:10px;">
            <?php $index = 1; foreach ($homework["files"] as $file): ?>
                <a target="_blank" href="<?= $file["url"] ?>"><?= $file["name"] ?? "[Lien $index]" ?></a>
                <?php if ($index + 1 <= count($homework["files"])): ?>· <?php endif; ?>
                <?php $index++; endforeach; ?>
        </div>
    </div>
    <?php endif; endforeach; ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
