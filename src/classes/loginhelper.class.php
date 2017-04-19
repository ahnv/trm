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

	/*
	*	LoginHelper->requestPassword
	*	@param Username Email
	*	@return Boolean
	*/

	public function requestPassword($username, $email){
		$username = $this->app->_cleanAlphaNumeric($username);
		$email = $this->app->_cleanEMAIL($email);
		try {
			$query = $this->db->prepare("SELECT `user_id` FROM `user` WHERE `username` = ? AND `email` = ?");
			$query->execute(array($username,$email));
			$row = $query->fetch(PDO::FETCH_ASSOC);
			if (isset($row['user_id'])){
				$token = $this->app->genToken();
				$qu = $this->db->prepare("INSERT INTO `token`(`user_id`, `token`,`type`) VALUES (?,?,1)");
				$qu->execute(array($row['user_id'],$token));
				(new Mail)->send($email,2, $token);
				return true;
			}
		} catch (PDOException $e) {
			SysLog::send($e);
		}
		return false;
	}


	/*
	*	LoginHelper->resetPassword
	*
	*/

	public function resetPassword($username,$token,$password){
		$username = $this->app->_cleanAlphaNumeric($username);
		$token = $this->app->_cleanAlphaNumeric($token,25);
		$password = $this->app->_cleanAlphaNumeric($password);
		if (!$username && !$token) return false;
		try{
			$query = $this->db->prepare("SELECT `token`.`user_id` FROM `token`,`user` WHERE `token`.`user_id` = `user`.`user_id` AND `user`.`username` = ? AND `token`.`token` = ? AND `token`.`type` = '1'");
			$query->execute(array($username,$token));
			$rows = $query->fetch(PDO::FETCH_ASSOC);
			if (isset($rows['user_id'])){
				$password = crypt($password,password_hash($password, PASSWORD_BCRYPT));
				$query = $this->db->prepare("UPDATE `user` SET `password` = ? WHERE `user`.`user_id` = ?;");
				$query->execute(array($password,$rows['user_id']));
				session_destroy();
				return true;
			}
		}catch(PDOException $e){
			SysLog::send($e);
		}
		return false;
	}
}