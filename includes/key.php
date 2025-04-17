<?php

if (!isset($ignoreActivation) || !$ignoreActivation) {
    if (!isset($_COOKIE["nots_activation_key"])) {
        header("Location: /activation");
        die();
    } else {
        $keys = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/includes/keys.json"), true);

        if (in_array($_COOKIE["nots_activation_key"], array_keys($keys))) {
            $key = $keys[$_COOKIE["nots_activation_key"]];

            if (strtotime($key["expiration"]) <= time()) {
                $fmt = new \IntlDateFormatter('fr_FR');
                $fmt->setPattern('d MMMM yyyy');

                header("Location: /activation/?error=La clé utilisée par votre navigateur n'est plus valide, elle était valide jusqu'au " . $fmt->format(new \DateTime($key["expiration"])));
                die();
            }
        } else {
            header("Location: /activation/?error=La clé utilisée par votre navigateur a été résiliée");
            die();
        }
    }
}