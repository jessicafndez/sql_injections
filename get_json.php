<?php
    echo "RESULTS--<br>";
    $str = file_get_contents('results.json');
    $json = json_decode($str, true);
    echo '<pre>' . print_r($json, true) . '</pre>';
?>
