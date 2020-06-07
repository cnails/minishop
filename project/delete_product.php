<?php
    session_start();
    if ($_SESSION['loggued_on_user'] == "admin" && $_GET['id']) {
        if (file_exists("../private/products")) {
            $data = unserialize(file_get_contents("../private/products"));
            if ($data) {
                foreach ($data as $el) {
                    if ($el['ind'] == $_GET['id']) {
                        continue;
                    }
                    $new_data[] = $el;
                }
                file_put_contents("../private/products", serialize($new_data));
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(false);
        }
    } else {
        echo json_encode(false);
    }
?>
