<?php
    session_start();
    if ($_SESSION['loggued_on_user']) {
        readfile("templates/header.html");
        readfile("templates/page.html");
        readfile("templates/footer.html");
    } else {
        header("Location: index.php");
    }
?>
