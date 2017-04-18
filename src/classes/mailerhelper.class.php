<?php

class mailHelper
{
	private $db,$app;
	public function __construct($db){ $this->db=$db; $this->app = new APP(); }

	public function get_rid($email)
	{
		$email=$this->app->_cleanEMAIL($email,$length=FALSE);
		$query=$this->db->prepare("select user_id from user where email=?"); //Email should be verified regardless of Upper/Lower case
		$query->execute(array($email));
		$rows=$query->fetchAll(PDO::FETCH_ASSOC);
		if(count($rows>0)) //correct syntax?
		{
			return $rows[0]['user_id'];
		}
		return false // NOT SURE IF WE SHOULD RETURN FALSE OR NOT RETURN OR EVEN IF WE SHOULD RETURN THE UID (RID) OR WE SHOULD STORE IT IN A VARIABLE

	}

	public function send_mail($uid,$sid,$rid,$subject,$content,$attachment,$status=0,$senderip,$timestamp)//should we pass parameters like timestamp senderip
	{
		// will we pass session id as uid? 
		// How the fuck are we handling attachments?
		//and why are there seperate uid and sid?
		//$username = $this->app->_cleanAlphaNumeric($username); added here for Pranav's reference :P Please remove if seen later
		$rid=get_rid($) // can't call since we're not passing email as of yet


		$subject=$this->app->_cleanAlphaNumericSpace($subject, $length = FALSE); //should we create a new cleaning fuction for email?
		$content=$this->app->_cleanAlphaNumericSpace($content, $length = FALSE);
		//attachment clean
	}

	public function get_unread_mails($userid)
	{
		$query=$this->db->prepare("SELECT subject,content,attachment from email where rid=? and status=?");
		$query->execute(array($userid,0));
		$query->execute(array($email));
		$rows=$query->fetchAll(PDO::FETCH_ASSOC);
		if(count($rows>0))  //correct syntax?
		{
			//Print emails , dk how to 
		}
		else
		print_r("\nNo Unread Emails.");
	}

	public function get_all_mails($userid)
	{
		$query=$this->db->prepare("SELECT subject,content,attachment from email where rid=?");
		$query->execute(array($userid));
		$query->execute(array($email));
		$rows=$query->fetchAll(PDO::FETCH_ASSOC);
		if(count($rows>0))  //correct syntax?
		{
			//Print emails , dk how to 
		}
		else
		print_r("\nNo Unread Emails.");
	}
}
