<?php
// prevent the server from timing out
set_time_limit(0);

// include the web sockets server script (the server is started at the far bottom of this file)
require 'class.PHPWebSocket.php';
require 'class.taobao.php';
require 'class.db.php';
require 'class.entity.php';
require 'class.redisOp.php';
// when a client sends data to the server
function wsOnMessage($clientID, $message, $messageLength, $binary) {
	
	global $taobao;
	global $onlines;
	global $Server;
	global $db;
	global $redis;
	// check if message length is 0
	if ($messageLength == 0) {
		$Server->wsClose($clientID);
		return;
	}
	//分析消息
	$messagejson = json_decode($message,true);

	var_dump($messagejson);
	switch($messagejson["type"]){
		case "login":
			$msg = null;
			$userin = $db->login($messagejson["playboard"]["username"],$messagejson["playboard"]["password"]);
            if($userin){
            	print_r($userin);
            	$user = new User($userin["id"], $messagejson["playboard"]["username"],long2ip( $Server->wsClients[$clientID][6]));
				$onlines->addUser($user,$clientID);
			    $msg = array("type"=>"login","playboard"=>$userin);
            }
            else $msg = array("type"=>"login","playboard"=>array("username"=>null));
			$Server->wsSend($clientID, json_encode($msg));
			break;
		case "getfriends":
			$res = $db->getFriends($messagejson["playboard"]["id"]);
			//var_dump($res);
			//print_r(json_encode($res));
			$msg = array("type"=>"getfriends","playboard"=>$res);
			$Server->wsSend($clientID, json_encode($msg));
			break;
		case "conversation":
			//if($messagejson["playboard"]["to"] != null && in_array($messagejson["playboard"]["to"],$clients))
			//var_dump($onlines);
			$toid = $onlines->getUserById($messagejson["playboard"]["to"]);
			//var_dump($toid);
            //var_dump($to.clientid);
            if($toid)
            	$Server->wsSend($toid,$message);
            else if($db->existsById($messagejson["playboard"]["to"])){
            	//添加到临时队列
                //print_r($toid."exist");
            	$redis->addMessage($messagejson["playboard"]["from"],$messagejson["playboard"]["to"],$messagejson["playboard"]["msg"],$messagejson["playboard"]["date"]);
            }
			break;
		case "conversations":
			$msgs = $redis->getMessages($messagejson["playboard"]["id"]);
			$msg = array("type"=>"conversations","playboard"=>$msgs);
			$Server->wsSend($clientID, json_encode($msg));
			break;
		case "search-user":
			$res = $db->searchUser($messagejson["playboard"]["id"]);
			$msg = array("type"=>"search-user","playboard"=>$res);
			$Server->wsSend($clientID, json_encode($msg));
		 	break;
		case "addfriend":
			$db->addFriend($messagejson["playboard"]["from"],$messagejson["playboard"]["to"]);
			$toid = $onlines->getUserById($messagejson["playboard"]["to"]);
			if($toid)
            	$Server->wsSend($toid,$message);
            else if($db->existsById($messagejson["playboard"]["to"])){
            	//添加到临时队列
                //print_r($toid."exist");
            	$redis->addNotify($messagejson["playboard"]["to"],$message);
            }
			break;
		case "getnotifys":
			$msgs = $redis->getNotify($messagejson["playboard"]["id"]);
			$msg = array("type"=>"getnotifys","playboard"=>$msgs);
			$Server->wsSend($clientID, json_encode($msg));
			break;
	}
	//$Server->wsSend($clientID, "xx");
	/**
	$ip = long2ip( $Server->wsClients[$clientID][6] );
	//The speaker is the only person in the room. Don't let them feel lonely.
	if ( sizeof($Server->wsClients) == 1 )
		$Server->wsSend($clientID, "There isn't anyone else in the room, but I'll still listen to you. --Your Trusty Server");
	else
		//Send the message to everyone but the person who said it
		foreach ( $Server->wsClients as $id => $client )
			if ( $id != $clientID )
				$Server->wsSend($id, "Visitor $clientID ($ip) said \"$message\"");
	*/
}

// when a client connects
function wsOnOpen($clientID)
{
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );
	$Server->log( "$ip ($clientID) has connected." );

	//Send a join notice to everyone but the person who joined
	//foreach ( $Server->wsClients as $id => $client )
	//	if ( $id != $clientID )
	//		$Server->wsSend($id, "Visitor $clientID ($ip) has joined the room.");
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
	global $Server;
    global $onlines;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip ($clientID) has disconnected." );

    $onlines->removeUser($clientID);
	//Send a user left notice to everyone in the room
	//foreach ( $Server->wsClients as $id => $client )
	//	$Server->wsSend($id, "Visitor $clientID ($ip) has left the room.");
}

$onlines = new OnLineUser();
$taobao = new Taobao();
$db = DB::getInstance();
$redis = RedisOp::getInstance();

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
$Server->wsStartServer('0.0.0.0', 9300);

?>
