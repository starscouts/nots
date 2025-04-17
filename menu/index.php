<?php

$title = "Menu";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

$menu = data_menu()["data"]["menu"];

?>

<div class="container">
    <br>

    <h2>Menu</h2>

    <?php foreach ($menu as $item): if ($item["date"] / 1000 < time()): ?>
    <details>
        <summary><?php

            $fmt = new \IntlDateFormatter('fr_FR');
            $fmt->setPattern('d MMM yyyy');
            echo $fmt->format(new \DateTime(date("c", ($item["date"] + 7200000) / 1000)));

            ?></summary>
        <table style="margin-top: 10px; margin-bottom: 20px;">
            <tr>
                <td></td>
                <td style="width:10px;"></td>
                <td style="width:5px;background-color:#C0C0C0;"></td>
                <td style="width:10px;"></td>
                <td>
                    <?php foreach ($item["meals"] as $index => $meal): ?>
                    <?php foreach ($meal as $mealItem): ?>
                        <p>
                            <?php foreach ($mealItem as $subitem): ?>
                            <?= $subitem["name"] ?><br>
                            <?php endforeach; ?>
                        </p>
                    <?php endforeach; ?>
                    <?= $index + 1 < count($item["meals"]) ? "<hr>" : "" ?>
                    <?php endforeach; ?>
                </td>
            </tr>
        </table>
    </details>
    <?php endif; endforeach; ?>
    <hr>
    <?php foreach ($menu as $item): if ($item["date"] / 1000 >= time()): ?>
        <details>
            <summary><?php

                $fmt = new \IntlDateFormatter('fr_FR');
                $fmt->setPattern('d MMM yyyy');
                echo $fmt->format(new \DateTime(date("c", ($item["date"] + 7200000) / 1000)));

                ?></summary>
            <table style="margin-top: 10px; margin-bottom: 20px;">
                <tr>
                    <td></td>
                    <td style="width:10px;"></td>
                    <td style="width:5px;background-color:#C0C0C0;"></td>
                    <td style="width:10px;"></td>
                    <td>
                        <?php foreach ($item["meals"] as $index => $meal): ?>
                            <?php foreach ($meal as $mealItem): ?>
                                <p>
                                    <?php foreach ($mealItem as $subitem): ?>
                                        <?= $subitem["name"] ?><br>
                                    <?php endforeach; ?>
                                </p>
                            <?php endforeach; ?>
                            <?= $index + 1 < count($item["meals"]) ? "<hr>" : "" ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
        </details>
    <?php endif; endforeach; ?>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
