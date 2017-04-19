<?php 

class Mail{
	public function send($to, $type, $token){
		if ($type == 1){
			$this->_send($to,"Verify Your Registration", "Your Registration Code is ".$token);
		}elseif ($type == 2 ){
			$this->_send($to,"Forgot Your Password", "Your Password Reset Code is ".$token);
		}
	}
	private function _send($to, $subject, $body){
		$message = array(
			'personalizations' => array(
				array(
					'to' => array(
						'email' => $to
						)
					)
				), 
			"from" => array(
				'email' => 'no-reply@right.mail'
				), 
			'subject' => $subject,
			'content' => array(
				array(
					'type'=> 'text/html',
					'value' => 'Hey,<br>'.$body.'<br>Thanks<br>Team TRM.'
					)
				)
			);
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
  		  CURLOPT_CAINFO => 'cacert.pem',
		  CURLOPT_POSTFIELDS => json_encode($message),
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer ".MAIL_API_KEY,
		    "cache-control: no-cache",
		    "content-type: application/json"
		  ),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	}
}