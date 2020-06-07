<?php
    session_start();
    if ($_SESSION['loggued_on_user']) {
        if (file_exists("../private/products")) {
            echo json_encode(unserialize(file_get_contents("../private/products")));
        } else {
            echo json_encode(false);
        }
    } else {
        header("Location: index.php");
    }
?>
