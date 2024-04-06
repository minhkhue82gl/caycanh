<?php

//Google Code
require_once ('./google/libraries/Google/autoload.php');

//Insert your cient ID and secret 
//You can get it from : https://console.developers.google.com/
$client_id = '725862815859-6otb7c1u68v4akh9rl2aqhbsgdaj2sdf.apps.googleusercontent.com';
$client_secret = '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';
$redirect_uri = 'http://localhost/web/index.php';
$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
$service = new Google_Service_Oauth2($client);
 if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit;
}
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
} else {
    $authUrl = $client->createAuthUrl();
}
if ($client->isAccessTokenExpired()) {
    $authUrl = $client->createAuthUrl();
   // header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}
if (!isset($authUrl)) {
    $googleUser = $service->userinfo->get();
    if(!empty($googleUser)){
        include 'function.php';
        loginFromSocialCallBack($googleUser);
    }
}
?>