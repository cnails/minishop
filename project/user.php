<?php
    session_start();
    if ($_SESSION['loggued_on_user']) {
        include("ft_get_money.php");
        $user['login'] = $_SESSION['loggued_on_user'];
        $user['money'] = get_money($_SESSION['loggued_on_user']);
        echo json_encode($user);
    } else {
        header("Location: index.php");
    }
?>
