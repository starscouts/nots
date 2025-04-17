<?php

$title = "À propos de Nots";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";
global $key;
global $fullVersion;

$pronoteVersion = data_params()["data"]["params"]["version"];

?>

<div class="container">
    <br><h2><?= $title ?></h2>

    <h4>Nots en quelques mots</h4>
    <p>L'application Pronote pour les élèves et parents, plus particulièrement l'application mobile, n'a jamais été de très grande qualité. Informations manquantes, bugs et lenteurs ne sont que quelques problèmes que les utilisateurs de Pronote doivent subir tous les jours. Nots tente de palier à ces problèmes en proposant une expérience alternative, vous permettant d'accéder aux informations dont vous avez besoin, dans une toute nouvelle application.</p>
    <p>Nots est développé bénévolement par les membres de <a href="https://raindrops.portal.equestria.horse" target="_blank">Raindrops System</a>.</p>

    <h4>Versions</h4>
    <p>
        <b>Nots</b> version <?= $fullVersion ?><br>
        <b>Pronote</b> version <?= $pronoteVersion ?><br>
        <b>PHP</b> version <?= PHP_VERSION ?>
    </p>

    <h4>Licence Nots</h4>

    <blockquote style="border-left:5px solid lightgray;padding-left:10px;margin-left:10px;">
        <b><?= $key["name"] ?></b><br>
        Autorisée à <?= $key["owner"] ?><br>
        Licence délivrée le <?php

        $fmt = new \IntlDateFormatter('fr_FR');
        $fmt->setPattern('d MMMM yyyy');
        echo $fmt->format(new \DateTime($key["start"]));

        ?><br>
        Abonnement actif jusqu'au <?php

        $fmt = new \IntlDateFormatter('fr_FR');
        $fmt->setPattern('d MMMM yyyy');
        echo $fmt->format(new \DateTime($key["expiration"]));

        ?><br>
        <?php if ($key["valid"]["all"]): ?>
            Utilisable pour toutes les instances Pronote
        <?php else: ?>
            Utilisable uniquement pour l'établissement <?= $key["valid"]["id"] ?>
        <?php endif; ?>
    </blockquote>
    <p>
        Cette licence vous permet d'accéder à Nots durant une période de temps limitée et en utilisant des serveurs limités, ce système est présent pour éviter les abus et s'assurer que seules des personnes dignes de confiance utilisent Nots. Si quelque chose ne vous parraît pas correct, vous pouver <a href="mailto:contact@minteck.org" target="_blank">contacter le support technique pour demander un renouvellement/changement de licence</a>.
    </p>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
