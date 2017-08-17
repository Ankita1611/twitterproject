<?php
session_start();
require "twitteroauth-master/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

try {
    $oauth_verifier = filter_input(INPUT_GET, 'oauth_verifier');
    //$oauth_verifier = filter_input(INPUT_GET, 'oauth_token');
     
     
    if (empty($oauth_verifier) ||
        empty($_SESSION['oauth_token']) ||
        empty($_SESSION['oauth_token_secret'])
    ) {
        //	echo "something wrong";
        // something's missing, go and login again
        header('Location: ./');
    }
    $_SESSION['oauth_verifier'] = $oauth_verifier;

    $consumer_key = "lryz094ovqNW1a8CQkIUt3AmL";
    $consumer_secret = "YO2NlXOvr9cxi51XKR0uEdo3zQf7pAj91ZkYt5a7ebGZvxo6hy";

    if (!isset($_SESSION['access_token'])) {
        $connection = new TwitterOAuth(
            $consumer_key,
            $consumer_secret,
            $_SESSION['oauth_token'],
            $_SESSION['oauth_token_secret']
        );
         
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
        //	 var_dump($access_token);
        // $user = $connection->get("account/verify_credentials");
        $_SESSION['access_token'] = $access_token;
    }
   
    $twitter = new TwitterOAuth(
        $consumer_key,
        $consumer_secret,
        $_SESSION['access_token']['oauth_token'],
        $_SESSION['access_token']['oauth_token_secret']
    );
    echo "<pre>";
    $statuses = $twitter->get("statuses/home_timeline", ["count"=>10]);
    //	var_dump($statuses);
    foreach ($statuses as $temp) {
        echo $temp->text."<br />";
    }
    $statuses = $twitter->get("followers/list", ["count"=>10]);
    var_dump($statuses);
    $id = "";
    foreach ($statuses->users as $temp) {
        echo $temp->name."<br />";
        $id = $temp->id;
    }
    //	echo $statuses->id;
    $statuses = $twitter->get("statuses/user_timeline", ["count"=>10, "user_id" => $id]);
   // var_dump($statuses);
    	foreach($statuses->users as $temp){
   	echo $temp->name."<br />";
	}
    
//	var_dump($statuses);
    
/*	// request user token
    $token = $connection->oauth(
        'oauth/access_token', [
            'oauth_verifier' => $oauth_verifier
        ]
    );
/*
    $twitter = new TwitterOAuth(
        $consumer_key,
        $consumer_secret,
        $token['oauth_token'],
        $token['oauth_token_secret']
    );*/

//	$statuses = $connection->get("search/tweets", ["q" => "twitterapi"]);
    //print_r($statuses);
}

//catch exception
catch (Exception $e) {
    echo 'Message: ' .$e->getMessage();
}
