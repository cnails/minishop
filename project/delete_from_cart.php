<?php
    session_start();
    if ($_SESSION['loggued_on_user'] && $_GET['id']) {
        if (file_exists("../private/cart")) {
            $i = 0;
            $data = unserialize(file_get_contents("../private/cart"));
            foreach ($data as $user) {
                if ($user['login'] == $_SESSION['loggued_on_user']) {
                    $cart = $user['cart'];
                    foreach ($cart as $el) {
                        if ($el == $_GET['id']) {
                            continue;
                        }
                        $new_data[] = $el;
                    }
                    // $data[$i]['login'] = $data[$i]['login'];
                    if ($new_data) 
                        $data[$i]['cart'] = $new_data;
                    else {
                        unset($data[$i]);
                    }
                    file_put_contents("../private/cart", serialize($data));
                    echo json_encode(true);
                    exit;
                }
                $i++;
            }
        } else {
            echo json_encode(false);
        }
    } else {
        echo json_encode(false);
    }
?>
