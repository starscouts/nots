<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/data.php";
$sessionManagerLoaded = true;

if (!isset($_COOKIE["nots_session"])) {
    header("Location: /login") and die();
}

$test = json_decode(@file_get_contents("http://127.0.0.1:21727/graphql", false, stream_context_create([
        "http" => [
            "method" => "POST",
            "header" => "Content-Type: application/json\r\n" .
                "Token: " . $_COOKIE["nots_session"],
            "content" => json_encode([
                "query" => "{
                    timetable (from: \"" . date('Y-m-d') . "\", to: \"" . date('Y-m-d') . "\") {
                        id
                    }
                }"])
        ]
    ])
), true)["data"]["timetable"];

if ($test === null) {
    header("Location: /login/?error=Session expirée, veuillez vous reconnecter") and die();
}