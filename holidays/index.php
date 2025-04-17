<?php

$title = "Vacances scolaires";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$params = data_params()["data"]["params"];
$holidays = $params["publicHolidays"];

?>

<div class="container">
    <br>
    <h2>Vacances scolaires</h2>

    <div class="alert alert-secondary">
        <b>Prochaines vacances :</b> <?php foreach (array_values(array_filter($holidays, function ($i) {
            return $i["from"] > time() * 1000;
        })) as $holiday): ?>
        <?= $holiday["name"] ?>
        (dans <?= $days = floor(($holiday["from"] - (time() * 1000)) / 86400000) ?> jours)
        <?php break; endforeach; ?>
    </div>

    <table>
        <?php foreach ($holidays as $holiday): ?>
            <tr>
                <td style="text-align:right;"><b><?= $holiday["name"] ?> :&nbsp;</b></td>
                <?php $days = floor(($holiday["to"] - $holiday["from"]) / 86400000); if ($days > 1): ?>
                <td>du <?php

                    $fmt = new \IntlDateFormatter('fr_FR');
                    $fmt->setPattern('d MMM yyyy');
                    echo $fmt->format(new \DateTime(date("c", $holiday["from"] / 1000 + 21600)));

                    ?> au <?php

                    $fmt = new \IntlDateFormatter('fr_FR');
                    $fmt->setPattern('d MMM yyyy');
                    echo $fmt->format(new \DateTime(date("c", $holiday["to"] / 1000 + 21600)));

                    ?></td>
                    <td>&nbsp;(<?= $days ?> jours)</td>
                <?php else: ?>
                <td><?php

                    $fmt = new \IntlDateFormatter('fr_FR');
                    $fmt->setPattern('d MMM yyyy');
                    echo $fmt->format(new \DateTime(date("c", $holiday["from"] / 1000 + 21600)));

                    ?></td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
