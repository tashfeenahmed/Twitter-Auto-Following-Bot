<?php

require_once('twitteroauth/twitteroauth.php');

class TwitterBot
{
	protected $oauth;

	public function __construct($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret)
	{
		$this->oauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
	}
	
	//Use this function if you want to tweet
	public function post($message)
	{
		$this->oauth->post('statuses/update', array('status' => $message));
	}

	public function search(array $query)
	{
		return $this->oauth->get('search/tweets', $query);
	}

	
	public function FollowNow($interest, $follow_limit)
	{

	$query = array(
	  "q"           => $interest,
	  "count"       => $follow_limit,
	  "result_type" => "recent",
	);

	$results = $this->search($query);
	foreach ($results->statuses as $result) {
	  $users_id[] = $result->user->id;
	}

	$users_id = array_unique($users_id);
	$new_followings = $this->autoFollowUserID($users_id);
	}
	
	
	public function autoFollowUserID($users_id = array())
	{
		
			$friends = $this->oauth->get('friends/ids', array('cursor' => -1));
			foreach ($users_id as $user_id) {
				if (!in_array($user_id, $friends->ids)) {
					sleep(10);
					$this->oauth->post('friendships/create', array('user_id' => $user_id));
					
				echo 'Followed User ID: <a href="https://twitter.com/intent/user?user_id='.$user_id.'" target="_blank">'.$user_id.'</a><br/><br/>';
				}
			}
		
	}
	
}
