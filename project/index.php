<?php
    session_start();
    if ($_SESSION['loggued_on_user']) {
        header("Location: market.php");
    } else {
        readfile("templates/header.html");
        readfile("templates/index.html");
        readfile("templates/footer.html");
    }
?>
