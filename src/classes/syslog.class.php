<?php

class SysLog{
  public static $embedLevel = true;
    
  public static function level2String($level){
    switch( $level ){
      case LOG_EMERG:   return "EMERGENCY"; break;
      case LOG_ALERT:   return "ALERT";     break;
      case LOG_CRIT:    return "CRITICAL";  break;
      case LOG_ERR:     return "ERROR";     break;
      case LOG_WARNING: return "WARNING";   break;
      case LOG_NOTICE:  return "NOTICE";    break;
      case LOG_INFO:    return "INFO";      break;
      case LOG_DEBUG:   return "DEBUG";     break;
    }
  }

  public static function send( $message, $level = LOG_NOTICE){
    if( self::$embedLevel ) $message = "[".self::level2String($level)."] ".$message;
    syslog($level, $message);
    error_log(date('[d-m-Y H:i e] '). '['. $level . ']' . $message . PHP_EOL, 3, LOG_FILE);
  }
}
