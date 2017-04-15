<?php
class APP {
  
  public function _cleanINT($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[0-9]+$/' : '/^[0-9]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlpha($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z]+$/' : '/^[a-zA-Z]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaNumeric($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z0-9]+$/' : '/^[a-zA-Z0-9]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanINTSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[0-9/s]+$/' : '/^[0-9/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z\s]+$/' : '/^[a-zA-Z/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaNumericSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z0-9/s]+$/' : '/^[a-zA-Z0-9/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }

  public function _cleanPassword($data, $length = FALSE){
    $regexp = (!$length) ? '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/' : '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,' . $length . '}$}/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp))); 
  }
  
  public function _cleanURL($data, $length = FALSE) {
    return filter_var($data, FILTER_SANITIZE_URL);
  }
  
  public function _cleanEMAIL($data, $length = FALSE) {
    return filter_var($data, FILTER_SANITIZE_EMAIL);
  }

  public function _cleanString($data, $length = FALSE) {
    return filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  }
  
  public function _getIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else 
      $ip = $_SERVER['REMOTE_ADDR'];
    return $ip;
  }

  public function genToken($length =FALSE){

    if (!$length) $length = 25;
    $token = "";
    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $max = strlen($codeAlphabet);
    for ($i=0; $i < $length; $i++) {
        $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max-1)];
    }
    return $token;
  }
  public function crypto_rand_secure( $min, $max ) {
    $range = $max - $min;
    if ( $range < 0 ) return $min; // not so random...
    $log    = log( $range, 2 );
    $bytes  = (int) ( $log / 8 ) + 1; // length in bytes
    $bits   = (int) $log + 1; // length in bits
    $filter = (int) ( 1 << $bits ) - 1; // set all lower bits to 1
    do {
      $rnd = hexdec( bin2hex( openssl_random_pseudo_bytes( $bytes ) ) );
      $rnd = $rnd & $filter; // discard irrelevant bits
    } while ( $rnd >= $range );
    return $min + $rnd;
  }
}