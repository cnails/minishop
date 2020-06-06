<?php
    session_start();
    include("ft_set_money.php");
    if ($_GET['login'] !== "" || $_GET['passwd'] !== "") {
        if (!file_exists("../private"))
            mkdir("../private");
        if (file_exists("../private/passwd")) {
            $data = unserialize(file_get_contents("../private/passwd"));
            foreach ($data as $key) {
                if ($key['login'] === $_GET['login']) {
                    echo json_encode(false);
                    return;
                }
            }
        }
        $user['login'] = $_GET['login'];
        $user['passwd'] = hash("whirlpool", $_GET['passwd']);
        $_SESSION['loggued_on_user'] = $_GET['login'];
        set_money($user['login'], 0);
        $data[] = $user;
        file_put_contents("../private/passwd", serialize($data));
        echo json_encode(true);
    } else {    
        echo json_encode(false);
        return;
    }
?>
