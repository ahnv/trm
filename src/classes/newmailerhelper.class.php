<?php

class mailerHelper
{
	private $db,$app;
	public function __construct($db)
	{
		$this->db=$db;
		$this->app=new APP();
	}

	public function sendMail($to,$subject,$content,$attachment)
	{
		$to=$this->app->_cleanEMAIL($to);
		$rid=$this->getRid($to);
		$sid=$_SESSION['user_id'];
		$sid=$this->app->_cleanINT($sid);
		$rid=$this->app->_cleanINT($rid);
		$subject=$this->app->_cleanString($subject);
		$content=$this->app->_cleanString($content);
		for ($i = 0 ; $i < count($attachment) ; $i++)
			$attachment[$i] = $this->app->_cleanURL($attachment[$i]);
		$attachment = implode(":", $attachment);
		if($to && $rid && $sid && $rid && $subject && $content)
		{
			$query=$this->db->prepare("INSERT into email('sid,rid,subject,content,attachment) VALUES (?,?,?,?,?)");
			$query->execute(array($sid,$rid,$subject,$content,$attachment));
			

		}
	}

	public function getRid($email)
	{
		$len=strpos($email,"@");
		$newMail=substr($email,0,$len);
		$query=$this->db->prepare("SELECT user_id from user where username=?");
		$query->execute(array($newMail));
		$row=$query->fetchAll(PDO::FETCH_ASSOC);
		if(count($row)>0)
		{
			$rid=$rows[0]['user_id'];
			return $rid;
		}
		else
			return false;

	}

}