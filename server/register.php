<?php
require('class.db.php');

$db = DB::getInstance();
 
$username = $_POST['username'];
$password = $_POST['password'];
$personal = $_POST['personal-label'];
$nickname = $_POST['nickname'];
$img = null;
if($db->exists($username)){
	echo '{"status":"exist"}';
	exit;
}
$lastid = $db->register($username, $password, $personal, 'server/'.$img, $nickname);
if($lastid == -1){
	echo '{"status":"error"}';
	exit;
}
// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif','zip');
//print_r($_FILES);
if(isset($_FILES['head_image_file']) && $_FILES['head_image_file']['error'] == 0){

	$extension = pathinfo($_FILES['head_image_file']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":"image-error"}';
		exit;
	}
	$img = 'userimage/'.$lastid.'.'.$extension;
	if(move_uploaded_file($_FILES['head_image_file']['tmp_name'], $img)){}
}
echo '{"status":"success"}';
?>
