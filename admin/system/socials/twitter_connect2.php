<?php 
session_start();

//LOADING LIBRARY
require "_sdk/Twitter/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//TWITTER APP KEYS
$consumer_key = '7cX6swbQp7PkJie6bZmptrlme';
$consumer_secret = 'DKg0NPkeNdLQLxn6hMUcMTg7tLyNCeTByDqJv8HoDGNdRx76pL';

//GETTING ALL THE TOKEN NEEDED
$oauth_verifier = $_GET['oauth_verifier'];
$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];

$token_secret = $_COOKIE['token_secret'];
$oauth_token = $_COOKIE['oauth_token'];

//EXCHANGING THE TOKENS FOR OAUTH TOKEN AND TOKEN SECRET
$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_verifier);
$connection->setTimeouts(20, 30);
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $oauth_verifier));

$_SESSION['access_token'] = $access_token;

require '../_app/Config.inc.php';

$AtualizaTwitter = new Update();


//$accessToken=$access_token['oauth_token'];
//$secretToken=$access_token['oauth_token_secret'];

//DISPLAY THE TOKENS
//echo "<b>Access Token : </b>".$accessToken."<br />";
//echo "<b>Secret Token : </b>".$secretToken."<br />";

 ?>