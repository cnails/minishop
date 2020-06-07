<?php
    $prices = array(1 => "600$", 2 => "1200$", 3=>"300$", 4=>"150$");
    file_put_contents("../private/price", serialize($prices));
?>
