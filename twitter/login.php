<?php
session_start();
require "twitteroauth-master/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

$consumer_key = "lryz094ovqNW1a8CQkIUt3AmL";
$consumer_secret = "YO2NlXOvr9cxi51XKR0uEdo3zQf7pAj91ZkYt5a7ebGZvxo6hy";
$access_token = "3848701513-qe017FEmF0mDMLPgU9a5WcX5Jaektft2w8QOtwP";
$access_token_secret = "L92qF9nnOsehV880S8knI55NsXN9q6EVjq9Nio1nPPa1e";
$connection = new TwitterOAuth($consumer_key, $consumer_secret);

$request_token = $connection->oauth(
    'oauth/request_token',
    [
        'oauth_callback' => 'http://ramanicare.com/twitter-ankita/hello'
    ]
);

if ($connection->getLastHttpCode() != 200) {
    throw new \Exception('There was a problem performing this request');
}
 
 $_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
 $url = $connection->url(
    'oauth/authorize',
 
     [
        'oauth_token' => $request_token['oauth_token']
    ]
);
// echo $url;
// and redirect
header('Location: '. $url);
