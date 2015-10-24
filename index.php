<?php
require_once('tb.php');

$key          = ''; // Your Consumer Key
$secret       = ''; // Your Consumer Secret
$token        = ''; // Your Access Token
$token_secret = ''; // Your Token Secret
$interest	  = 'design'; // Your keyword to follow
$follow_limit = '10'; // Twitter has its own limit so you might not be able to follow many users in a single day

$bot = new TwitterBot($key, $secret, $token, $token_secret);
$bot->FollowNow($interest,$follow_limit);

?>
