<?php

global $ignoreActivation;
global $title;

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/key.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/data.php";

function getUserID() {
    $data = data_params()["data"]["params"];
    $user = data_user()["data"]["user"];

    return hash("sha512", $data["establishment"] . "|||" . $user["name"]);
}

function getSubject($name) {
    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . getUserID() . ".json"), true);

    $id = md5($name);

    if (isset($data["subjects"][$id])) {
        return $data["subjects"][$id];
    } else {
        return $name;
    }
}

$version = "2023";
$fullVersion = "2023.0.0.1";

global $sessionManagerLoaded;

if (isset($_COOKIE["nots_session"]) && isset($sessionManagerLoaded) && $sessionManagerLoaded) {
    $_userID = getUserID();

    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/includes/users")) mkdir($_SERVER['DOCUMENT_ROOT'] . "/includes/users");
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $_userID . ".json")) file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $_userID . ".json", "{}");

    $data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $_userID . ".json"), true);
    $_name = $data["student"] ?? data_user()["data"]["user"]["name"];
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= isset($title) ? $title . " - Nots" : "Nots" ?> <?= $version ?></title>
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <script src="/bootstrap/bootstrap.bundle.min.js"></script>
</head>
<body>