<?php
$base_url = "https://www.boredhumans.com/api_faces2.php";

function getImage() : ?string
{
    global $base_url;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $base_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0");
    $curl_response = curl_exec($ch);
    curl_close($ch);

    // <img src="https://boredhumans.b-cdn.net/faces2/610.jpg" alt="610" height="256" width="256" />
    $regex = '/<img src="https:\/\/boredhumans.b-cdn.net\/faces2\/(\d+).jpg"/i';
    preg_match($regex, $curl_response, $matche);
    if (isset($matche[1])) {
        return $matche[1];
    }
    return null;
}

var_dump(getImage());
