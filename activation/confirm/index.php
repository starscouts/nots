<?php $title = "Confirmation d'activation"; $ignoreActivation = true;

$keys = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/keys.json"), true);

if (isset($_POST["_nots_activation_key"])) {
    $_POST["_nots_activation_key"] = trim($_POST["_nots_activation_key"]);

    if (in_array($_POST["_nots_activation_key"], array_keys($keys))) {
        $key = $keys[$_POST["_nots_activation_key"]];

        if (strtotime($key["expiration"]) <= time()) {
            $fmt = new \IntlDateFormatter('fr_FR');
            $fmt->setPattern('d MMMM yyyy');

            header("Location: /activation/?error=La clé entrée n'est plus valide, elle était valide jusqu'au " . $fmt->format(new \DateTime($key["expiration"])));
            die();
        }
    } else {
        header("Location: /activation/?error=La clé entrée n'existe pas");
        die();
    }
} else {
    header("Location: /activation/?error=Aucune clé entrée");
    die();
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"; ?>

<div class="container">
    <br>
    <h1>Activation</h1>

    <p>La clé que vous avez entrée active la licence suivante :</p>

    <blockquote style="border-left:5px solid lightgray;padding-left:10px;margin-left:10px;">
        <p>
            <b><?= $key["name"] ?></b><br>
            Autorisée à <?= $key["owner"] ?><br>
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
        </p>
    </blockquote>

    <?php if (strtotime($key["expiration"]) - time() <= 1209600): ?>
        <div class="alert alert-warning container">
            <b>Attention :</b> Cette licence expire
            <?php if (strtotime($key["expiration"]) - time() > 86400): $days = floor((strtotime($key["expiration"]) - time()) / 86400); ?>
                dans <?= $days ?> jour<?= $days > 1 ? "s" : "" ?> (le <?php

                $fmt = new \IntlDateFormatter('fr_FR');
                $fmt->setPattern('d MMMM yyyy');
                echo $fmt->format(new \DateTime($key["expiration"]));

                ?>).
            <?php else: ?>
                aujourd'hui.
            <?php endif; ?>

            Votre accès à Nots risque d'être interrompu par l'expiration de votre licence. Des instructions pour la renouveler vous seront présentées plus tard.
        </div>
    <?php endif; ?>

    <p>Après avoir cliqué sur Activer, vous pourrez utiliser Nots sur cet appareil pour accéder aux serveurs Pronote de l'établissement associé à votre licence et pour la durée de votre licence.</p>

    <form action="/activation/finish" method="post">
        <input type="hidden" name="_nots_activation_key" value="<?= $_POST["_nots_activation_key"] ?>">
        <input type="submit" value="Activer" class="btn btn-primary">
    </form>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>