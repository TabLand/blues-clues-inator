<?php
    include "imgur.php";
    include "imgur_lib.php";

    $imgur_link = $_GET["imgur"];

    $imgur_id      = get_imgur_id($imgur_link);
    $json          = get_image_details($imgur_id);

    header("application/json");
    echo $json;
?>
