<?php
/*
*	LoginHelper
*	Contains all functions related to login
*/
class LoginHelper{
	private $db, $app;
	public function __construct($db){ $this->db=$db; $this->app = new APP(); }
	
	/*
	*	LoginHelper->login	
	*	@param Username Password
	*	@return int
	*	>	-3 : SQL Query Exception
	*	>	-2 : Incomplete Form
	*	>	-1 : Username Not Found
	*	>	0 : Unverified User
	*	>	1 : Verified User
	*	>	2 : Banned User
	*/
	public function login($username,$password) {
		$username = $this->app->_cleanAlphaNumeric($username);
		if ($username && $password){
			try{
				$query= $this->db->prepare("SELECT `user_id`, `password`, `status` FROM `user` WHERE `username` = ?");
		       	$query->execute(array($username));
		       	$row = $query->fetch(PDO::FETCH_ASSOC);
		       	if (isset($row['password'])){
		       		if(hash_equals($row['password'], crypt($password, $row['password']))){
		       			$_SESSION['logged_in'] = true;
		       			$_SESSION['user'] = $username;
		       			$_SESSION['status'] = $row['status'];
		       			$_SESSION['user_id'] = $row['user_id'];
		       			return $row['status'];
		       		}
		       	}
		       	return -1;
			} catch(PDOException $e){
				SysLog::send($e);
				return -3;
			}
		}
		return -2;
	}

	/*
	*	LoginHelper->getCurrentStatus	
	*	@param uid
	*/

	public function getCurrentStatus($uid){
		$query = $this->db->prepare("SELECT `status` FROM `user` WHERE `user_id` = ?");
		$query->execute(array($uid));
		$rows = $query->fetch(PDO::FETCH_ASSOC);
		if (isset($rows['status'])){
			$_SESSION['status'] = $rows['status'];
		}
		return true;
	}

}