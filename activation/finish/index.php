<?php $title = "Activation terminée"; $ignoreActivation = true;

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

setcookie("nots_activation_key", $_POST["_nots_activation_key"], time() + (86400 * 365), "/", "", false, true);

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"; ?>

<div class="container">
    <br>
    <h1>Activation</h1>

    <p>Votre licence est maintenant activée, merci d'utiliser Nots.</p>

    <a href="/login" class="btn btn-primary">Terminer</a>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>