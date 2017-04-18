<?php

/*
*	RegisterHelper
*	Contains all functions related to Registration
*/


class registerHelper{
	private $db, $app;

	public function __construct($db){ $this->db=$db; $this->app = new APP(); }

	/*
	*	RegisterHelper->Register	
	*	@param Username Password FirstName LastName DateOfBirth Gender Email Country
	*	@return int
	*	>	-3 : SQL Query Exception
	*	>	-2 : Incomplete Form
	*	>	-1 : Username Already Exists
	*	>	0 : User not created
	*	>	1 : User Successfully Created
	*/
	public function register($username,$password,$fname,$lname,$birthdate,$gender,$email,$country) {
		$username = $this->app->_cleanAlphaNumeric($username);
		$fname = $this->app->_cleanAlphaSpace($fname);
		$lname = $this->app->_cleanAlphaSpace($lname);
		$gender = $this->app->_cleanAlpha($gender,1);
		$email = $this->app->_cleanEMAIL($email);
		$country = $this->app->_cleanAlphaSpace($country);
		$password = crypt($password,password_hash($password, PASSWORD_BCRYPT));
		if ($username && $password && $fname && $lname && $birthdate && $gender && $email && $country){
			$dob = explode("/", $birthdate);
			$birthdate = implode("-", array($dob[2],$dob[0],$dob[1]));
			try{
				$this->db->beginTransaction();
				$query= $this->db->prepare("
					INSERT INTO 
						`user`(`username`,`password`,`fname`,`lname`,`birthdate`,`gender`,`email`,`country`) 
					VALUES 
						(?,?,?,?,?,?,?,?)");
				$query->execute(array( $username,  $password, $fname, $lname, $birthdate, $gender, $email, $country));
				$query = $this->db->prepare("
					SELECT `user_id` FROM `user` WHERE `username` = ? 
					");
				$query->execute(array($username));
				$userid = $query->fetch(PDO::FETCH_ASSOC);
				if (isset($userid['user_id'])){
					$token = $this->app->genToken();
					$qu = $this->db->prepare("INSERT INTO `token`(`user_id`, `token`,`type`) VALUES (?,?,0)");
					$qu->execute(array($userid['user_id'],$token));			
					$this->db->commit();
					(new Mail)->send($email,1, $token);
					return 1;
				}
				$this->db->rollBack();
				return 0;
			} catch(PDOException $e){
				$this->db->rollBack();
				SysLog::send($e);
				if ($e->errorInfo[1] == 1062) return -1;
				return -3;
			}
		}
		return -2;
	}
}