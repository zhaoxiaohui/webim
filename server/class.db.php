<?php
/*
 * Created on 2013-11-5
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 error_reporting(E_ALL | E_STRICT);
 require('class.DBHelper.php');
 
 class DB{
 	private $dbhelper = null;
 	private static $__instance = null;

    private function __construct(){
    	$this->initDB();
    }

	protected function initDB(){
		$this->dbhelper = new DBHelper();
    	$this->dbhelper->initDb("127.0.0.1","taoliao","root","root");
	}
    public static function getInstance(){
        if(is_null(self::$__instance)){
            self::$__instance = new self();
        }
        return self::$__instance;
    }
 	public function getFriends($id){
        $sql = "select `id`,`nickname`,`username`,`labels`,`img` from user where id in(select `userid2` from friends where userid=:userid)";
        $res = $this->dbhelper->selectAll($sql,array("userid"=>(int)$id));
        //print_r(count($res));
        if(!$res || count($res) ==0)
 			return null;
 		return $res[0];   
 	}
 	public function searchUser($id){
 		$sql = "select `id`,`nickname`,`username`,`labels`,`img` from user where id=:id";
 		$res = $this->dbhelper->selectAll($sql,array("id"=>(int)$id));
        //print_r(count($res));
        if(!$res || count($res) ==0)
 			return array();
 		return $res;   
 	}
 	public function login($username, $password){
 		$sql = "select `id`,`nickname`,`username`,`labels`,`img`,`point` from user where username=:username and password=:password";
 		$res = $this->dbhelper->selectAll($sql,array("username"=>$username,"password"=>$password));
 		if(count($res) ==0)
 			return null;
 		return $res[0];
 	}
 	
 	public function register($username,$password,$labels,$img,$nickname){
 		$sql = "insert into user(`username`,`password`,`labels`,`img`,`nickname`) values(:username,:password,:labels,:img,:nickname)";
 		$lastid = $this->dbhelper->insert($sql,array("username"=>$username,"password"=>$password,"labels"=>$labels,"img"=>$img,"nickname"=>$nickname));
 		return $lastid;
 	}
 	
 	public function exists($username){
 		$sql = "select * from user where username= :username";
 		$res = $this->dbhelper->testexists($sql,array("username"=>$username),"username");
 		return $res;
 	}
 	
 	public function existsById($id){
        //$id = (int)$id;
 		$sql = "select * from user where id=:id";
        //print_r($id);
 		$res = $this->dbhelper->testexists($sql,array("id"=>$id),"id");
 		return $res;
 	}
 	
 	public function modidyImg($id,$img){
 		$sql = "update user set img=:img where id=:id";
 		$this->dbhelper->update($sql,array("img"=>$img,"id"=>$id));
 	}
 	
 	public function addFriend($id1, $id2){
 		
 	}
 }
?>
