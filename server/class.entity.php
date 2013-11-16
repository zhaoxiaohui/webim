<?php
/*
 * Created on 2013-11-4
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
class User{
	public $username = null;
	public $curip = null;
	public $id;
	public function User($id, $username, $ip){
		$this->id = $id;
		$this->username = $username;
		$this->curip = $ip;
	}
}

class OnLineUser{
	private $users = array();
	
	public function addUser($user, $clientid){
		$this->users[$clientid] = $user;
		print_r($this->users[$clientid]);
	}
	public function getUser($name){
        print_r($name);
        foreach($this->users as $key=>$user){
            if($user->username == $name){
                return $key;
            }
        }
		//if(array_key_exists($name,$this->users)){
		//	return $this->users[$name];
		//}
        print_r("false");
		return null;
	}
	public function getUserById($id){
        print_r($id);
        foreach($this->users as $key=>$user){
            if($user->id == $id){
                return $key;
            }
        }
		//if(array_key_exists($name,$this->users)){
		//	return $this->users[$name];
		//}
        print_r("false");
		return null;
	}
    public function removeUser($clientid){
        if(array_key_exists($clientid,$this->users)){
            unset($this->users[$clientid]);    
        }       
    }
}
?>
