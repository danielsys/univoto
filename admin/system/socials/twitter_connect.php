<?php


require("../_sdk/Twitter/autoload.php");

session_start();

use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', '7cX6swbQp7PkJie6bZmptrlme');
define('CONSUMER_SECRET', 'DKg0NPkeNdLQLxn6hMUcMTg7tLyNCeTByDqJv8HoDGNdRx76pL');
//define('OAUTH_CALLBACK', 'http://www.univoto.com.br/twitter.php');
//define('PARAM1', "3091781476-ncJTgcllxUVLr4pzqvNOHhfYPCY0Sd4aQHc5V2q");
//define('PARAM2', "SP2TaqhRCMTpyirlKS2uWO083KKJMHv9z7MghFtrPsr8x");

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$connection->setTimeouts(20, 30);

$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://localhost/univoto/admin/painel.php?exe=social/twitter_connect2"));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$oauth_token=$request_token['oauth_token'];
$token_secret=$request_token['oauth_token_secret'];

setcookie("token_secret", " ", time()-3600);
setcookie("token_secret", $token_secret, time()+60*10);
setcookie("oauth_token", " ", time()-3600);
setcookie("oauth_token", $oauth_token, time()+60*10);

header("Location:https://api.twitter.com/oauth/authorize?oauth_token=" . $_SESSION['oauth_token']);

