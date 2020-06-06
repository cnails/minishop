<!--
    session_start();
    if ($_SESSION['loggued_on_user']) {
        if ($_GET['user']) {
            include("ft_get_money.php");
            return get_money($_GET['user']);
        }
        echo json_encode(false);
    } else {
        header("Location: index.php");
    }
 -->
