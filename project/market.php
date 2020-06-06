<?php
    session_start();
    if (!$_SESSION['loggued_on_user']) {
        header("Location: index.php");
    } else {
        readfile("templates/header.html");
        readfile("templates/market.html");
        readfile("templates/products.html");
        readfile("templates/footer.html");
    }
?>
