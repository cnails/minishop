<?php
    session_start();
    if ($_SESSION['loggued_on_user'] && $_GET['sum'] && preg_match('/^-?[0-9]+$/', $_GET['sum'])) {
        include("ft_set_money.php");
        $login = $_SESSION['loggued_on_user'];
        $sum = $_GET['sum'];
        echo json_encode(set_money($login, $sum));
    } else 
        echo json_encode(false);
?>
