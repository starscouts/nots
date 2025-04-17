<?php

$title = "Fichiers partagés";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

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
            <li><a class="dropdown-item" href="/homework">Devoirs</a></li>
            <li><a class="dropdown-item disabled" href="#">Fichiers</a></li>
        </ul>
    </div>

    <table>
        <?php $index = 1; foreach (data_files()["data"]["files"] as $file): ?>
        <tr>
            <td style="text-align:right;"><b><?= getSubject($file["subject"]) ?></b></td>
            <td>&nbsp;·&nbsp;</td>
            <td><a target="_blank" href="<?= $file['url'] ?>"><?= $file["name"] ?? "[Lien $index]" ?></a></td>
            <td>&nbsp;·&nbsp;</td>
            <td>déposé le <?php

                $fmt = new \IntlDateFormatter('fr_FR');
                $fmt->setPattern('d MMMM yyyy');
                echo $fmt->format(new \DateTime(date("c", ($file["time"] + 7200000) / 1000)));

                ?></td>
        </tr>
        <?php $index++; endforeach; ?>
    </table>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
