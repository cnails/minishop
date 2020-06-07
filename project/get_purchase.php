<?php
    session_start();
    if ($_SESSION['loggued_on_user'] == "admin") {
        if (file_exists("../private/purchase")) {
            echo json_encode(unserialize(file_get_contents("../private/purchase")));
        } else {
            echo json_encode(false);
        }
    }
?>
