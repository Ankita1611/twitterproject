<?php
session_start();
require "twitteroauth-master/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

//print_r($_GET);

if (isset($_SESSION['access_token']['oauth_token']) &&
    isset($_SESSION['access_token']['oauth_token_secret']) &&
    isset($_SESSION['access_token']) &&
    isset($_SESSION['access_token']['oauth_token']) &&
    isset($_GET['screen_name'])
    ) {
} else {
    //	header("location:./");
}
$screen_name =    $_GET['screen_name'];
$consumer_key = "lryz094ovqNW1a8CQkIUt3AmL";
$consumer_secret = "YO2NlXOvr9cxi51XKR0uEdo3zQf7pAj91ZkYt5a7ebGZvxo6hy";

$twitter = new TwitterOAuth(
    $consumer_key,
    $consumer_secret,
    $_SESSION['access_token']['oauth_token'],
    $_SESSION['access_token']['oauth_token_secret']
);
//	echo "<pre>";
//	$tweets = $twitter->get("statuses/home_timeline",["count"=>10]);
//	var_dump($statuses);
    //foreach($tweets as $temp){
    //	echo $temp->text."<br />";
//	}
//	$followers = $twitter->get("followers/list",["count"=>10]);
//	var_dump($statuses);
    $id = "";
/*	foreach($statuses->users as $temp){
        echo $temp->name."<br />";
        $id = $temp->id;
    }
//	echo $statuses->id;
*/
    
    $tweets = $twitter->get("statuses/user_timeline", ["count"=>10, "screen_name" => $screen_name]);
//	var_dump($tweets);

?>								
<?php
    foreach ($tweets as $temp) {
        ?>
	<div class="owl-item " >
		<div class="slide" >
			<div class="row" >
			<!--	<div class="col-md-6" >
					<div class="tweet-image" >
						<img src="p.jpg" />
					</div>
				</div> -->
				<div class="col-md-12" >
					<div class="tweet text-center" >
					<?php echo $temp->text; ?>
					</div>
				</div>
			
			</div>
			
	   </div>
	</div>				
	<?php
    } ?>
