<?php
    include "imgur.php";

    function get_imgur_id($link){
        $bits      = explode("/",$link);
        $imgur_id  = array_pop( $bits );
        preg_match("/[A-Za-z0-9]+/",$imgur_id,$matches);

        $clean_id = $matches[0];
        return $clean_id;
    }

    function get_image_details($img_id){
        $api_url = "https://api.imgur.com/3/image/$img_id";

        $handle = curl_init($api_url);

        $auth_header = "Authorization: Client-ID " . CLIENT_ID;

        curl_setopt($handle, CURLOPT_HTTPHEADER, array( $auth_header ) );
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $json = curl_exec($handle);

        curl_close($handle);
        return $json;
    }
?>
