<?php 
session_start();
/**
 * users gets redirected here from twitter (if user allowed you app)
 * you can specify this url in https://dev.twitter.com/ and in the previous script
 */ 

//SHOW
echo '<p>$_SESSION[\'oauth_token\']: ' . $_SESSION['oauth_token'] . "</p>";
echo '<p>$_SESSION[\'oauth_token_secret\']: ' . $_SESSION['oauth_token_secret'] . "</p>";

//LOADING LIBRARY
require "_sdk/Twitter/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

//TWITTER APP KEYS
$consumer_key = '7cX6swbQp7PkJie6bZmptrlme';
$consumer_secret = 'DKg0NPkeNdLQLxn6hMUcMTg7tLyNCeTByDqJv8HoDGNdRx76pL';

//GETTING ALL THE TOKEN NEEDED
$oauth_verifier = $_GET['oauth_verifier'];
$_SESSION['oauth_verifier'] = $_GET['oauth_verifier'];

//$token_secret = $_SESSION['oauth_token_secret']; //$_COOKIE['token_secret'];
//$oauth_token = $_GET['oauth_token'];

$token_secret = $_COOKIE['token_secret'];
$oauth_token = $_COOKIE['oauth_token'];

var_dump($_SESSION);
var_dump($_COOKIE);

//EXCHANGING THE TOKENS FOR OAUTH TOKEN AND TOKEN SECRET
$connection = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_verifier);
$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $oauth_verifier));


var_dump($access_token);

$accessToken=$access_token['oauth_token'];
$secretToken=$access_token['oauth_token_secret'];

//DISPLAY THE TOKENS
echo "<b>Access Token : </b>".$accessToken."<br />";
echo "<b>Secret Token : </b>".$secretToken."<br />";


//$accessToken=$access_token['oauth_token'];
//$secretToken=$access_token['oauth_token_secret'];

//DISPLAY THE TOKENS
//echo "<b>Access Token : </b>".$accessToken."<br />";
//echo "<b>Secret Token : </b>".$secretToken."<br />";

 ?>