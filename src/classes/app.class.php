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
    $regexp = (!$length) ? '/^[a-zA-Z/s]+$/' : '/^[a-zA-Z/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }
  
  public function _cleanAlphaNumericSpace($data, $length = FALSE) {
    $regexp = (!$length) ? '/^[a-zA-Z0-9/s]+$/' : '/^[a-zA-Z0-9/s]{' . $length . '}+$/';
    return filter_var($data, FILTER_VALIDATE_REGEXP, array('options'=>array('regexp' => $regexp)));
  }

  public function _cleanPassword($data, $length == FALSE){
    $regexp = (!$length) ? '/^(?=.*[A-Za-z])(?=.*/d)[A-Za-z/d]{8,}$/' : '/^(?=.*[A-Za-z])(?=.*/d)[A-Za-z/d]{8,' . $length . '}$}/';
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
}