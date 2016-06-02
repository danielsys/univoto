<?php

require '_sdk/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1690616507858495',
  'app_secret' => 'caad747e92e0a96af72c2989dee1957a',
  'default_graph_version' => 'v2.6',
  //'default_access_token' => '{access-token}', // optional
]);

    

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
   $perms = ['manage_pages', 'publish_pages'];
   $redirect_url = 'http://www.univoto.com.br/face2.php';
   
   $loginURL = $helper->getLoginUrl($redirect_url, $perms);
   
   echo "<a href=\"{$loginURL}\">Login</a>";
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

/* try {
  // Get the Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me', 'EAAYBm1RmZCj8BAF3Mr6GE6r8NVFTAxMmeZBUFCIqPZCGSiii9ZBVfesdGItfzZAVwv50SBLoKHAZADTCFtOQohCiUTEu8VxePgb4ZCEDnZAqWfrNLjdjFkDxWMRKAqCVshkZArifuVF5glbGvylHdUADHMLqwZCKavd14FgLtvrFF4uQZDZD');  //EAACEdEose0cBANY7zqaUboSLmy6AH7erWxGoyFJUZBZAXlduNsKkNoYazHqrb5LkThZCzgXBvb5RuxGBwVtZANjO9pZBkRvBBDf22SsEtLkp58pblZCFGqpjgqfoWOPv1ad1FS8ssOuZCg6ivvqObcdCaEa5Md8GZCZCw9ZBjkvuUc5gZDZD
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
var_dump($me);
echo 'Logged in as ' . $me->getName();
 * 
 */
   
   
   session_start();

$helper = new FacebookRedirectLoginHelper('http://www.univoto.com.br/face2.php', '1690616507858495', 'caad747e92e0a96af72c2989dee1957a');

try {
    $session = $helper->getSessionFromRedirect();
} catch(FacebookSDKException $e) {
    $session = null;
}

if ($session) {
  // User logged in, get the AccessToken entity.
  $accessToken = $session->getAccessToken();
  // Exchange the short-lived token for a long-lived token.
  $longLivedAccessToken = $accessToken->extend();
  // Now store the long-lived token in the database
  // . . . $db->store($longLivedAccessToken);
  // Make calls to Graph with the long-lived token.
  // . . . 
} else {
  echo '<a href="' . $helper->getLoginUrl() . '">Login with Facebook</a>';
}