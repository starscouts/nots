<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/key.php";

$request = file_get_contents("http://127.0.0.1:21727/auth/logout", false, stream_context_create([
    "http" => [
        "method" => "POST",
        "header" => "Content-Type: application/json\r\n" .
            "Token: " . $_COOKIE["nots_session"],
        "content" => json_encode([
            "token" => $_COOKIE["nots_session"]
        ])
    ]
]));

setcookie("nots_session");
header("Location: /login");
die();