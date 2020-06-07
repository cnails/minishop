<?php
    session_start();
    if ($_SESSION['loggued_on_user']) {
        if (file_exists("../private/cart")) {
            $data = unserialize(file_get_contents("../private/cart"));
            foreach ($data as $user) {
                if ($user['login'] === $_SESSION['loggued_on_user']) {
                    echo json_encode($user['cart']);
                    exit;
                }
            }
        }
        echo json_encode(false);
    }
?>
