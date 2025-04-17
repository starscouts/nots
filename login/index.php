<?php $title = "Connexion"; require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/header.php"; global $key; ?>

<div class="container">
    <br>
    <h1>Connexion</h1>

    <?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger">
        <b>Erreur :</b> <?= str_replace("%RM%", "<a href='/credentials'>En savoir plus.</a>", strip_tags($_GET["error"])) ?>
    </div>
    <?php endif; ?>

    <form action="/login/auth.php" method="post">
        <div class="mb-3 mt-3">
            <label for="server" class="form-label">Serveur :</label>
            <input <?= !$key["valid"]["all"] ? "disabled" : "" ?> type="text" id="server" class="form-control" placeholder="Serveur" name="server" value="<?= !$key["valid"]["all"] ? $key["valid"]["url"] : "" ?>">
        </div>
        <div class="mb-3 mt-3">
            <label for="username" class="form-label">Nom d'utilisateur :</label>
            <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur" name="username">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password">
        </div>
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="save"> Enregistrer mes identifiants
            </label>
        </div>
        <button type="submit" class="btn btn-primary" onclick="saveCredentials();">Connexion</button>
    </form>
</div>

<script>
    function saveCredentials() {
        if (document.getElementsByName("save")[0].checked) {
            localStorage.setItem("credentials", JSON.stringify({
                username: document.getElementById("username").value,
                password: document.getElementById("password").value,
                server: document.getElementById("server").value
            }));
        } else {
            localStorage.removeItem("credentials");
        }
    }

    function loadCredentials() {
        if (localStorage.getItem("credentials") !== null) {
            let credentials = JSON.parse(localStorage.getItem("credentials"));

            document.getElementsByName("save")[0].checked = true;
            document.getElementById("username").value = credentials.username;
            document.getElementById("password").value = credentials.password;
            if (!document.getElementById("server").disabled) document.getElementById("server").value = credentials.server;
        }
    }

    window.onload = () => {
        loadCredentials();
    }
</script>

<?php require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"; ?>