<?php
    session_start();
    if ($_SESSION['loggued_on_user'] == "admin") {
        readfile("templates/header.html");
        readfile("templates/admin.html");
        readfile("templates/orders.html");
        readfile("templates/footer.html");
    } else {
        header("Location: index.php");
    }
?>
