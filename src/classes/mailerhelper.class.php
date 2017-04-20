<?php

class MailerHelper
{
	private $db,$app;
	public function __construct($db){
		$this->db=$db;
		$this->app=new APP();
	}

	public function sendMail($to,$subject,$content,$attachment = FALSE)	{
		$to=$this->app->_cleanEMAIL($to);
		$rid=$this->getRid($to);
		$sid=$_SESSION['user_id'];
		$sid=$this->app->_cleanINT($sid);
		$subject=$this->app->_cleanString($subject);
		$content=$this->app->_cleanString($content);
		for ($i = 0 ; $i < count($attachment) ; $i++) $attachment[$i] = $this->app->_cleanURL($attachment[$i]);
		$attachment = implode(":", $attachment);
		if($rid && $sid && $subject && $content){
			$query=$this->db->prepare("INSERT into email(sid,rid,subject,content,attachment,senderip) VALUES (?,?,?,?,?,?)");
			$query->execute(array($sid,$rid,$subject,$content,$attachment,$this->app->_getIP()));
			return true;
		}
	}

	public function getRid($email){
		$username=substr($email,0,strpos($email,"@"));
		$query=$this->db->prepare("SELECT user_id from user where username=?");
		$query->execute(array($username));
		$row=$query->fetchAll(PDO::FETCH_ASSOC);
		return (count($row)>0)?$row[0]['user_id']:false;
	}

	public function getRecievedMails($userid){
		$userid = $this->app->_cleanINT($userid);
		try{
			$query = $this->db->prepare("SELECT `uid`,`sid`, `rid`, `subject`, `content`, `attachment`, `status`, `timestamp` FROM `email` WHERE `rid` = ? ORDER BY `timestamp` DESC");
			$query->execute(array($userid));
			$rows  = $query->fetchAll(PDO::FETCH_ASSOC);
			$mails = array('Inbox'=> array() , 'Archived' => array(), 'Deleted' => array());
			for ($i = 0 ; $i < count($rows); $i++){
				$status = $rows[$i]['status'];
				unset($rows[$i]['status']);
				$q = $this->db->prepare("SELECT CONCAT(`user`.`username`,'@right.mail') as `uname` FROM `user` WHERE `user_id` = ?");
				$q->execute(array($rows[$i]['sid']));
				$sid = $q->fetch(PDO::FETCH_ASSOC);
				$q->execute(array($rows[$i]['rid']));
				$rid = $q->fetch(PDO::FETCH_ASSOC);
				$rows[$i]['sid'] = $sid['uname'];
				$rows[$i]['rid'] = $rid['uname'];
				switch ($status) {
					case '0': $rows[$i]['read'] = 0; $mails['Inbox'][] = $rows[$i]; break;
					case '1': $rows[$i]['read'] = 1; $mails['Inbox'][] = $rows[$i]; break;
					case '2': $mails['Archived'][] = $rows[$i]; break;
					case '3': $mails['Deleted'][]= $rows[$i]; break;
				}
			}
			return $mails;
		}catch(PDOException $e){
			SysLog::send($e);
		}
	}

	public function getSentMail($userid){
		$userid = $this->app->_cleanINT($userid);
		try{
			$query = $this->db->prepare("SELECT `uid`,`sid`, `rid`, `subject`, `content`, `attachment`, `status`, `timestamp` FROM `email` WHERE `sid` = ? ORDER BY `timestamp` DESC");
			$query->execute(array($userid));
			$rows  = $query->fetchAll(PDO::FETCH_ASSOC);
			$mails = array();
			for ($i = 0 ; $i < count($rows); $i++){
				$status = $rows[$i]['status'];
				unset($rows[$i]['status']);
				$q = $this->db->prepare("SELECT CONCAT(`user`.`username`,'@right.mail') as `uname` FROM `user` WHERE `user_id` = ?");
				$q->execute(array($rows[$i]['sid']));
				$sid = $q->fetch(PDO::FETCH_ASSOC);
				$q->execute(array($rows[$i]['rid']));
				$rid = $q->fetch(PDO::FETCH_ASSOC);
				$rows[$i]['sid'] = $sid['uname'];
				$rows[$i]['rid'] = $rid['uname'];
				$mails[] = $rows;
			}
			return $mails;
		}catch(PDOException $e){
			SysLog::send($e);
		}
	}

}