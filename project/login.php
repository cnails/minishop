<?php
    include ("auth.php");
    session_start();
    if ($_GET['login'] && $_GET['passwd']) {
        $login = $_GET['login'];
        if (auth($login, $_GET['passwd'])) {
            $_SESSION['loggued_on_user'] = $_GET['login'];
            echo json_encode(true);
            return;
        } else {
            $_SESSION['loggued_on_user'] = "";
            echo json_encode(false);
            return;
        }
    } else {
        $_SESSION['loggued_on_user'] = "";
        echo json_encode(false);
    }
?>
