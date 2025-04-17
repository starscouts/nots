<?php

$title = "Accueil";

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/navigation.php";

global $key;

?>

<?php if (strtotime($key["expiration"]) - time() <= 1209600): ?>
<br>
<div class="alert alert-warning container">
    <b>Avertissement :</b> Votre licence Nots (<?= $key["name"] ?>) expire
    <?php if (strtotime($key["expiration"]) - time() > 86400): $days = floor((strtotime($key["expiration"]) - time()) / 86400); ?>
    dans <?= $days ?> jour<?= $days > 1 ? "s" : "" ?> (le <?php

        $fmt = new \IntlDateFormatter('fr_FR');
        $fmt->setPattern('d MMMM yyyy');
        echo $fmt->format(new \DateTime($key["expiration"]));

        ?>).
    <?php else: ?>
    aujourd'hui.
    <?php endif; ?>

    Une fois votre licence expirée, vous ne pourrez plus utiliser Nots. <a href="mailto:contact@minteck.org" target="_blank">Contactez le support technique</a> pour obtenir un renouvellement si vous êtes toujours éligible pour utiliser Nots.
</div>
<?php endif; ?>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>
