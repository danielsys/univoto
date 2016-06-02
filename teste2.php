<?php

require '_sdk/Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1690616507858495',
  'app_secret' => 'caad747e92e0a96af72c2989dee1957a',
  'default_graph_version' => 'v2.6',
  //'default_access_token' => '{access-token}', // optional
]);

    $linkData = [
      'link' => 'http://www.zoomtech.com.br',
      'message' => 'Conheça o maior portal de tecnologia do Brasil',
      ];

    try {
      // Returns a `Facebook\FacebookResponse` object
      $response = $fb->post('/me/feed', $linkData, 'EAAYBm1RmZCj8BALPURvJ8DWqkm5RzQQbg9Ees76CsJQQl1OiEzSVHIBN8XohZAnI1tDmpekLAZC1Yq9SYHOL54ZBckVZAmjHiN611Qo0qXRujUi8StGHbMw9QYr92kVtixMBSjDuLzSkGvwHda5w5dImY94WvIYUijOxRIYFVuwZDZD');
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

    $graphNode = $response->getGraphNode();

    echo 'Posted with id: ' . $graphNode['id'];

?>