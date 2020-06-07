<?php
    session_start();
    if ($_SESSION['loggued_on_user'] && $_GET['id']) {
        if (file_exists("../private/cart")) {
            $data = unserialize(file_get_contents("../private/cart"));
            $tmp_user = -1;
            $i = 0;
            foreach ($data as $user) {
                if ($user['login'] === $_SESSION['loggued_on_user']) {
                    $tmp_user = $i;
                    $cart = $user['cart'];
                    $cart[] = $_GET['id'];
                    $data[$tmp_user]['cart'] = $cart;
                    file_put_contents("../private/cart", serialize($data));
                    echo json_encode(true); 
                }
                $i++;
            }
            if ($tmp_user === -1) {
                // создать нового
                // $cart[] = $id;
                $user['cart'][] = $_GET['id'];
                $user['login'] = $_SESSION['loggued_on_user'];
                $data[] = $user;
                file_put_contents("../private/cart", serialize($data));
                echo json_encode(true); 
            }
        } else {
            $cart[] = $_GET['id'];
            $user['cart'] = $cart;
            $user['login'] = $_SESSION['loggued_on_user'];
            $data[] = $user;
            file_put_contents("../private/cart", serialize($data));
            echo json_encode(true); 
        }
    } else {
        echo json_encode(false);
    }
?>
