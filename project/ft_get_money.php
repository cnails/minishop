<?php
    function get_money($login) {
        if (file_exists("../private/users")) {
            $data = unserialize(file_get_contents("../private/users"));
            foreach ($data as $user) {
                if ($user['login'] === $login) {
                    return $user['sum'];
                }
            }
        }
        return false;
    }
?>
