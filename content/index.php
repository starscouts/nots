<?php

$title = "Cours";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$contents = data_contents()["data"]["contents"];

?>

<div class="container">
    <br>
    <h2>Cours</h2>

    <div class="dropdown" style="margin-bottom: 10px;">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Contenus
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/timetable">Emploi du temps</a></li>
            <li><a class="dropdown-item disabled" href="#">Contenus</a></li>
            <li><a class="dropdown-item" href="/homework">Devoirs</a></li>
            <li><a class="dropdown-item" href="/files">Fichiers</a></li>
        </ul>
    </div>

    <?php $i = 2; foreach (array_reverse($contents) as $content): ?>
    <details open>
        <summary>
            <b><?= getSubject($content["subject"]) ?></b> · <?= implode(", ", $content["teachers"]) ?> · <?php

            $fmt = new \IntlDateFormatter('fr_FR');
            $fmt->setPattern('d MMM yyyy');
            echo $fmt->format(new \DateTime(date("c", ($content["from"] + 7200000) / 1000)));

            ?>
        </summary>

        <div style="margin-top: 5px; padding-top: 5px; margin-left: 10px; padding-left: 10px; border-left-style: solid; border-color: <?= $content["color"] ?>; border-left-width: 5px;">
            <h5><?= $content["title"] ?></h5>
            <?= $content["htmlDescription"] ?? str_replace("\n", "<br>", strip_tags($content["description"])) ?>
            <div style="margin-top:10px;">
                <?php $index = 1; foreach ($content["files"] as $file): ?>
                    <a target="_blank" href="<?= $file["url"] ?>"><?= $file["name"] ?? "[Lien $index]" ?></a>
                    <?php if ($index + 1 <= count($content["files"])): ?>· <?php endif; ?>
                <?php $index++; endforeach; ?>
            </div>
        </div>

        <?php if ($i <= count($contents)): ?><hr><?php endif; ?>
    </details>
    <?php $i++; endforeach; ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
