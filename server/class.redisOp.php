<?php
/*
 * Created on 2013-11-15
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 /*=======================================*\
 * @author zh
 * Redis相关操作
 * 单例模式
\*=======================================*/
class RedisOp {
 /* private vars */
	private static $redis = null;
	private static $redisOp = null;
    private function __construct() {
    	self::$redis = new Redis();
    	self::$redis->connect('127.0.0.1');
    }
    
    static function getInstance(){
        if(is_null(self::$redisOp))
            self::$redisOp = new self();
        return self::$redisOp;
    }
    
    public function addMessage($from, $to, $message, $date){
    	$this->redis->sAdd($to, $from);
    	$this->redis->lPush($to.':'.$from.'message', $message);
    	$this->redis->lPush($to.':'.$from.'date', $date);
    }
    
    public function getMessages($id){
    	$users = $this->redis->sMembers($id);
    	$res = array();
    	foreach($users as $value){
    		$from = $value;
    		$to = $id;
    		$one = array("from"=>$from, "to"=>$to);
    		$msgs = array();
    		$dates = array();
    		while(true){
				$onemsg = $this->redis->rPop($to.':'.$from.'message');
				if(!$onemsg)break;
				$onedate = $this->redis->rPop($to.':'.$from.'date');
				array_push($msgs, $onemsg);
				array_push($dates, $onedate);
    		}
    		$one['msg'] = $msgs;
    		$one['date'] = $dates;
    		
    		array_push($res, $one);
    		$this->redis->sRem($to, $from);
    	}
    	return $res;
    }
    
}
?>
