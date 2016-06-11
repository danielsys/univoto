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
//$oauth_verifier = $_GET['oauth_verifier'];
//$token_secret = $_SESSION['oauth_token_secret']; //$_COOKIE['token_secret'];
//$oauth_token = $_GET['oauth_token'];

var_dump($_SESSION);
var_dump($_COOKIE);

echo "<p>Cunsumer_key: {$consumer_key}</p>";
echo "<p>consumer_secret: {$consumer_secret}</p>";
echo "<p>oauth_token: {$_SESSION['oauth_token']}</p>";
echo "<p>oauth_token_secret: {$_SESSION['oauth_token_secret']}</p>";


//EXCHANGING THE TOKENS FOR OAUTH TOKEN AND TOKEN SECRET
$connection = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
echo "<font color=blue>";
var_dump($connection);
echo "</font>";

echo "<font color=red>";
$statuses = $connection->get("statuses/home_timeline", ["count" => 25, "exclude_replies" => true]);
var_dump($statuses);





echo "</font>";

//$access_token = $connection->url("oauth/autorize", array("oauth_token" => $_SESSION['oauth_token']));
//var_dump($access_token);

//$user_info = $connection->get('account/verify_credentials');
//var_dump($user_info);

//$statuses = $connection->get("search/tweets", ["q" => "twitterapi"]);
//var_dump($statuses);

//$accessToken=$access_token['oauth_token'];
//$secretToken=$access_token['oauth_token_secret'];

//DISPLAY THE TOKENS
//echo "<b>Access Token : </b>".$accessToken."<br />";
//echo "<b>Secret Token : </b>".$secretToken."<br />";


//$accessToken=$access_token['oauth_token'];
//$secretToken=$access_token['oauth_token_secret'];

//DISPLAY THE TOKENS
//echo "<b>Access Token : </b>".$accessToken."<br />";
//echo "<b>Secret Token : </b>".$secretToken."<br />";

 ?>