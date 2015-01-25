<?php
    include "imgur_lib.php";

    $imgur_link = $_GET["imgur"];

    $imgur_id      = get_imgur_id($imgur_link);
    $json          = get_image_details($imgur_id);

    $image_details = json_decode($json,true);

    $image_type = $image_details["data"]["type"];
    $animated   = $image_details["data"]["animated"];

    if($image_type == "image/gif" && $animated){
        $image_url = $image_details["data"]["link"];
        $animation = new Imagick($image_url);
        echo get_delay($animation);
    }
    else echo "miss!";

    function get_delay($animation){
        $delays = 0;
        foreach($animation as $frame){
            $delay_in_centiseconds += $animation->getImageDelay() . "\n";
        }
        $delay_in_ms = $delay_in_centiseconds * 10;
        return $delay_in_ms;
    }
?>
