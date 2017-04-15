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
		
			return true;	
		}
		return false;
	}
}