<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/key.php"; global $key;

if (!isset($_POST["username"]) || trim($_POST["username"]) === "" ||
    !isset($_POST["password"]) || trim($_POST["password"]) === ""
) {
    header("Location: /login/?error=Données de connexion incorrectes");
    die();
}

$data = [
    "url" => $key["valid"]["url"],
    "username" => $_POST["username"],
    "password" => $_POST["password"]
];

if ($key["valid"]["all"]) {
    if (!isset($_POST["server"]) || trim($_POST["server"]) === "" || !filter_var($_POST["server"], FILTER_VALIDATE_URL)) {
        header("Location: /login/?error=Données de connexion incorrectes");
        die();
    }

    $data["url"] = $_POST["server"];
}

$request = file_get_contents("http://127.0.0.1:21727/auth/login", false, stream_context_create([
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/json",
        "content" => json_encode($data)
    ]
]));

if ($request === false) {
    header("Location: /login/?error=Identifiants incorrects, vous ne devez pas entrer vos identifiants d'ENT. %RM%");
} else {
    $token = json_decode($request, true)["token"];

    $space = json_decode(file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $token,
            "content" => json_encode([
                "query" => "{params{title}}"
            ])
        ]
    ])), true)["data"]["params"]["title"];

    if ($space !== "Espace Élèves") {
        header("Location: /login/?error=Seul l'espace élève est supporté pour le moment");
        die();
    }

    setcookie("nots_session", $token, 0, "/", "", false, true);
    header("Location: /");
}