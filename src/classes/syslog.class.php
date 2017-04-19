<?php

class SysLog{
  public static function send( $message, $level = LOG_NOTICE){
    error_log(date('[d-m-Y H:i e] '). $message . PHP_EOL, 3, LOG_FILE);
  }
}
