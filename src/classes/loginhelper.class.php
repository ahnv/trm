<?php

class loginHelper{
	private $db;
	public function __construct($db){ $this->db=$db; }
	public function login($user,$pass)
	 {
		$user = $this->app->_cleanAlphaNumeric($username);
		//To clean password or now?
		//sanitising or validating 
		
		if($user && $pass)
		{
			$query=$this->db->prepare("SELECT username,password,user_id from user where username=? and password=?");
			$query->execute(array($user,$pass));
			$rows=$query->fetchAll(PDO::FETCH_ASSOC);
			if(count($rows)>0) {
				$_SESSION['logged_in'] = true;                  //Session Variables kahi define karne padhte hai ya apne aap yaha ho jaayenge define?
				$_SESSION['username'] = $rows[0]['username'];
				$_SESSION['password'] = $rows[0]['password'];
				$_SESSION['user_id'] = $rows[0]['user_id'];
				return true;
			}


		}
		return false;

	}

	public static function checkUser($user)
	{
		$query=$this->db->prepare("select username from user where username=?");
		$query->execute(array($user));
		$rows=$query->fetchAll(PDO::FETCH_ASSOC);
		if(count($rows)==1)	return true;
		return false;
	}
}