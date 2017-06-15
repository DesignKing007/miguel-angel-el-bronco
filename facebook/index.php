<?php

require 'facebook.php';

$app_id = "108915649195488";
$app_secret = "1d1b8024879c4990aa5ded721fc76c04";
$facebook = new Facebook(array(
        'appId' => $app_id,
        'secret' => $app_secret,
        'cookie' => true
));

$signed_request = $facebook->getSignedRequest();

$page_id = $signed_request["page"]["id"];
$page_admin = $signed_request["page"]["admin"];
$like_status = $signed_request["page"]["liked"];
$country = $signed_request["user"]["country"];
$locale = $signed_request["user"]["locale"];

// If a fan is on your page
if ($like_status) {
$a = file_get_contents("http://miguelangelelbronco.com/facebook/home_page.html");
echo ($a);
} else {
// If a non-fan is on your page
$a = file_get_contents("http://miguelangelelbronco.com/facebook/reveal.html");
echo ($a);
}

?>