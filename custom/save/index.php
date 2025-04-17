<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/session.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/key.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/data.php";

function getUserID() {
    $data = data_params()["data"]["params"];
    $user = data_user()["data"]["user"];

    return hash("sha512", $data["establishment"] . "|||" . $user["name"]);
}

$marks = data_marks()["data"]["marks"]["subjects"];
$timetable = data_timetable()["data"]["timetable"];
$subjects = [];
$userID = getUserID();

foreach ($timetable as $class) {
    $subjects[md5($class["subject"])] = $class["subject"];
}

foreach ($marks as $subject) {
    if (!in_array($subject, array_values($subjects))) {
        $subjects[md5($subject["name"])] = $subject["name"];
    }
}

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $userID . ".json")) file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $userID . ".json", "{}");
$data = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $userID . ".json"), true);

if (isset($_POST["student"]) && trim($_POST["student"]) !== "") {
    $data["student"] = str_replace('"', "''", strip_tags($_POST["student"]));
} else {
    $data["student"] = data_user()["data"]["user"]["name"];
}

if (!isset($data["subjects"])) $data["subjects"] = [];

if (isset($_POST["subject"])) {
    foreach ($subjects as $id => $subject) {
        if (isset($_POST["subject"][$id]) && trim($_POST["subject"][$id]) !== "") {
            $data["subjects"][$id] = str_replace('"', "''", strip_tags($_POST["subject"][$id]));
        } else {
            $data["subjects"][$id] = $subject;
        }
    }
}

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/users/" . $userID . ".json", json_encode($data));

header("Location: /custom");
die();