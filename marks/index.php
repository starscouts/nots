<?php

$title = "Notes";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$marks = data_marks();

?>

<div class="container">
    <br><h2><?= $title ?></h2>

    <p><b>Moyenne générale : </b> <?= $marks["data"]["marks"]["averages"]["student"] ?>/20 (classe : <?= $marks["data"]["marks"]["averages"]["studentClass"] ?>/20)</p>

    <table>
    <?php foreach ($marks["data"]["marks"]["subjects"] as $subject): ?>
        <tr>
            <td></td>
            <td style="width:10px;"></td>
            <td style="width:5px;background-color:<?= $subject["color"] ?>;"></td>
            <td style="width:10px;"></td>
            <td>
                <b><?= getSubject($subject["name"]) ?></b><br>
                Élève : <?= $subject["averages"]["student"] ?>/20 · Classe : <?= $subject["averages"]["studentClass"] ?>/20<br>

                <table style="margin-top: 10px;">
                    <?php foreach (array_reverse($subject["marks"]) as $mark): ?>
                        <tr>
                            <td></td>
                            <td style="width:10px;"></td>
                            <td style="width:5px;opacity:.3;background-color:<?= $subject["color"] ?>;"></td>
                            <td style="width:10px;"></td>
                            <td>
                                <b><?php

                                    $fmt = new \IntlDateFormatter('fr_FR');
                                    $fmt->setPattern('d MMMM yyyy');
                                    echo $fmt->format(new \DateTime(date("c", ($mark["date"] + 7200000) / 1000)));

                                    ?> · <?php if ($mark["isAway"]): ?>Absent·e<?php else: ?><?= $mark["value"] ?>/<?= $mark["scale"] ?><?php endif; ?></b><br>
                                Coeff. <?= $mark["coefficient"] ?><?php if (isset($mark["title"]) && trim($mark["title"]) !== ""): ?> · <?= $mark["title"] ?><?php endif; ?>
                                <div style="margin-top: 5px;margin-left: 10px;">
                                   ± <?= $mark["average"] ?> &nbsp; ↑ <?= min($mark["max"], $mark["scale"]) ?> &nbsp; ↓ <?= max($mark["min"], 0) ?>
                                </div>
                            </td>
                        </tr>
                        <tr style="height:5px;"></tr>
                    <?php endforeach; ?>
                </table>
            </td>
        </tr>
        <tr style="height:20px;"></tr>
    <?php endforeach; ?>
    </table>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
