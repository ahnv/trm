<?php

class registerHelper{
	private $db, $app;
	public function __construct($db){ $this->db=$db; $this->app = new APP(); }
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
					$qu = $this->db->prepare("INSERT INTO `token`(`user_id`, `token`,`type`) VALUES (?,?,0)");
					$qu->execute(array($userid['user_id'],$this->app->genToken()));					
					$this->db->commit();
					return 1;
				}
				$this->db->rollBack();
				return 0;
			} catch(PDOException $e){
				$this->db->rollBack();
				SysLog::send($e);
				return -1;
			}
			return 1;
		}
		return 0;
	}
}