<?php

$title = "Cours";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$timetable = data_timetable()["data"]["timetable"];

?>

<div class="container">
    <br>
    <h2>Cours</h2>

    <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
            Emploi du temps
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item disabled" href="#">Emploi du temps</a></li>
            <li><a class="dropdown-item" href="/content">Contenus</a></li>
            <li><a class="dropdown-item" href="/homework">Devoirs</a></li>
            <li><a class="dropdown-item" href="/files">Fichiers</a></li>
        </ul>
    </div>

    <table>
    <?php $day = null; $lastEnd = null; $index = 0; foreach ($timetable as $lesson): $newDay = false; if ($lesson["to"] / 1000 > time()): ?>
        <?php if ($day !== date('d-m-Y', $lesson["to"] / 1000)): $newDay = true; ?>
        </table>
        <h4 style="margin-top:15px;"><?php

            $lastEnd = null;

            $fmt = new \IntlDateFormatter('fr_FR');
            $fmt->setPattern('d MMM yyyy');
            echo $fmt->format(new \DateTime(date("c", ($lesson["to"] + 7200000) / 1000)));

            ?></h4>
        <table>
        <?php $day = date('d-m-Y', $lesson["to"] / 1000); endif; ?>
        <?php if (isset($lastEnd) && $lastEnd < $lesson["from"]): $distance = $lesson["from"] - $lastEnd; ?>
            <tr>
                <td></td>
                <td style="width:10px;"></td>
                <td style="width:5px;background-color:#e8e8e8;"></td>
                <td style="width:10px;"></td>
                <td><i><?= $distance < 900000 ? "Récréation (" . ceil(($distance + 300000) / 60000) . " min)" : "Pas de cours" ?></i></td>
            </tr>
            <tr style="height:5px;"></tr>
        <?php endif; ?>
        <tr>
            <td style="text-align: right;display:grid;height:98px;grid-template-rows: 1fr 1fr;">
                <?php if ($newDay): ?>
                <div><b><?= date("H:i", ($lesson["from"] + 7200000) / 1000) ?></b></div>
                <?php else: ?>
                <div><?= date("H:i", ($lesson["from"] + 7200000) / 1000) ?></div>
                <?php endif; ?>

                <?php if (isset($timetable[$index + 1]) && $day !== date('d-m-Y', $timetable[$index + 1]["to"] / 1000)): ?>
                <div style="display: flex;align-items: end;justify-content: right;"><b><?= date("H:i", ($lesson["to"] + 6900000) / 1000) ?></b></div>
                <?php else: ?>
                <div style="display: flex;align-items: end;justify-content: right;"><?= date("H:i", ($lesson["to"] + 6900000) / 1000) ?></div>
                <?php endif; ?>
            </td>
            <td style="width:10px;"></td>
            <td style="width:5px;background-color: <?= $lesson["color"] ?>;"></td>
            <td style="width:10px;"></td>
            <td>
                <?php if (isset($lesson["status"])): ?>
                <span class="text-muted"><?= $lesson["status"] ?></span><br>
                <?php endif; ?>
                <b><?= getSubject($lesson["subject"]) ?></b><br>
                <?= $lesson["teacher"] ?><?php if (isset($lesson["room"])): ?><br>
                <?= $lesson["room"] ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr style="height:5px;"></tr>
    <?php $lastEnd = $lesson["to"]; endif; $index++; endforeach; ?>
    </table>

    <hr>
    <pre><?php var_dump($timetable); ?></pre>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
