<?php
    function set_money($login, $sum) {
        $tmp_user = -1;
        $i = 0;
        if (file_exists("../private/users")) {
            $data = unserialize(file_get_contents("../private/users"));
            foreach ($data as $user) {
                if ($user['login'] === $login) {
                    $tmp_user = $i;
                    break;
                }
            }
            if ($tmp_user === -1) {
                $user['login'] = $login;
                $user['sum'] = $sum;
                $data[] = $user;
                file_put_contents("../private/users", serialize($data));
                return json_decode(true);
            }
                // return json_decode(false);
            $data[$tmp_user]['login'] = $data[$tmp_user]['login'];
            $data[$tmp_user]['sum'] = $data[$tmp_user]['sum'] + $sum;
            file_put_contents("../private/users", serialize($data));
            return json_decode(true);
        }
        else {
            $user['login'] = $login;
            $user['sum'] = $sum;
            $data[] = $user;
            file_put_contents("../private/users", serialize($data));
            return json_decode(true);
        }
    }
?>
