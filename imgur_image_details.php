<?php
    include "imgur.php";
    error_reporting(E_ALL);

    $imgur_link = $_GET["imgur"];

    $imgur_id = get_imgur_id($imgur_link);

    get_image_details($imgur_id);

    function get_imgur_id($link){
        $pattern  = "/https?:\/\/[www]?imgur\.com\/gallery\//";
        $imgur_id = preg_replace($pattern,"",$link);
        preg_match("/[A-Za-z]+/",$imgur_id,$matches);

        $clean_id = $matches[0];
        return $matches[0];
    }

    function get_image_details($img_id){
        $api_url = "https://api.imgur.com/3/image/$img_id";
        
        $handle = curl_init($api_url);

        curl_setopt($handle, CURLOPT_HEADER, "Authorization: Client-ID " . CLIENT_ID . "\r\n");
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($handle);
        echo $content;

        curl_close($handle);
    }
?>
