<?php $title = "Activation"; $ignoreActivation = true; require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"; ?>

<div class="container">
    <br>
    <h1>Activation</h1>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <b>Erreur :</b> <?= str_replace("%RM%", "<a href='/credentials'>En savoir plus.</a>", strip_tags($_GET["error"])) ?>
        </div>
    <?php endif; ?>

    <p>Nots est un logiciel privé et son utilisation nécessite une clé d'activation. Vous devez avoir reçu une clé d'activation de la part du support technique ; si ce n'est pas le cas, merci de <a href="mailto:contact@minteck.org" target="_blank">contacter le support technique</a>. Merci donc d'entrer votre clé d'activation ci-dessous :</p>

    <form method="post" action="/activation/confirm">
        <p>
            <textarea name="_nots_activation_key" class="form-control font-monospace" spellcheck="false" rows="5" style="resize: none;"></textarea>
        </p>
        <input type="submit" value="Continuer" class="btn btn-primary">
    </form>
</div>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>