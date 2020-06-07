<?php
    session_start();
    if ($_SESSION['loggued_on_user'] === "admin") {
        if($_GET['item'] !== "" || $_GET['image'] !== "" || $_GET['category'] !== "" || $_GET['price'] !== "")
        {
            if ($_GET['local'] == "true") {
                if (!file_exists($_GET['image'])) {
                    echo json_encode(false);
                    return;
                }
            }
            $i = 1;
            if (file_exists("../private/products")) {
                $data = unserialize(file_get_contents("../private/products"));
                foreach ($data as $key) {
                    if ($key['item'] === $_GET['item']) {
                        echo json_encode(false);
                        return;
                    }
                    if ($key['ind'] >= $i) {
                        $i = $key['ind'] + 1;
                    }
                }
            }
            $product['item'] = $_GET['item'];
            $product['image'] = $_GET['image'];
            $product['category'] = $_GET['category'];
            $product['price'] = $_GET['price'];
            $product['ind'] = $i;
            $data[] = $product;
            file_put_contents("../private/products", serialize($data));
            echo json_encode($i);
        } else {
            echo json_encode(false);
        }  
        } else {
            echo json_encode(false);
        }
?>