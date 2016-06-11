<?php


require("_sdk/Twitter/autoload.php");

session_start();

use Abraham\TwitterOAuth\TwitterOAuth;

echo "<pre>";

define('CONSUMER_KEY', '7cX6swbQp7PkJie6bZmptrlme');
define('CONSUMER_SECRET', 'DKg0NPkeNdLQLxn6hMUcMTg7tLyNCeTByDqJv8HoDGNdRx76pL');
define('OAUTH_CALLBACK', 'http://www.univoto.com.br/twitter.php');
define('PARAM1', "3091781476-ncJTgcllxUVLr4pzqvNOHhfYPCY0Sd4aQHc5V2q");
define('PARAM2', "SP2TaqhRCMTpyirlKS2uWO083KKJMHv9z7MghFtrPsr8x");

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$connection->setTimeouts(20, 30);

//$url = $connection->url("oauth/authorize", ["oauth_token" => "3091781476-ncJTgcllxUVLr4pzqvNOHhfYPCY0Sd4aQHc5V2q"]);
//echo '<a href="'. $url.  '">Entrar</a>';

//$request_token = $connection->oauth(OAUTH_CALLBACK);
//$content = $connection->get("request_token");
//$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://www.univoto.com.br/twitte.php"));
$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://localhost/univoto/tw2.php"));

//$page = $connection->getRequestToken('http://localhost.com/twitter_oauth.php');  

//var_dump($connection);
//var_dump($request_token);

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$oauth_token=$request_token['oauth_token'];
$token_secret=$request_token['oauth_token_secret'];

setcookie("token_secret", " ", time()-3600);
setcookie("token_secret", $token_secret, time()+60*10);
setcookie("oauth_token", " ", time()-3600);
setcookie("oauth_token", $oauth_token, time()+60*10);

header("Location:https://api.twitter.com/oauth/authorize?oauth_token=" . $_SESSION['oauth_token']);

//$request_token = $connection->getRequestToken('http://www.univoto.com.br/twitter.php');

/*
$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

var_dump($request_token);

$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

var_dump($url);


*/