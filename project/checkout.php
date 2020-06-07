<?php
    session_start();
    if ($_SESSION['loggued_on_user']) {
        if (file_exists("../private/cart")) {
            $data = unserialize(file_get_contents("../private/cart"));
            foreach ($data as $user) {
                if ($user['login'] === $_SESSION['loggued_on_user']) {
                    $cart = $user;
                    break;
                }
            }
            if (file_exists("../private/purchase")) {
                $data = unserialize(file_get_contents("../private/purchase"));
                $data[] = $cart;
                file_put_contents("../private/purchase", serialize($data));
            }
        }
    } else {
        header("Location: index.php");
    }
?>
