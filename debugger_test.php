<?php 
$url="http://dev.chrysaliscostumes.com/product/cosplay/video-games/costume-test1";
$ch = curl_init("https://developers.facebook.com/tools/explorer/145634995501895/?method=POST&path=?scrape=true&id=".$url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $a = curl_exec($ch);
print_r($a);
?>
