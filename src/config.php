<?php
define('LIVE', false);

if (!LIVE){
  define( 'URL',     'http://localhost/trm/' );
  define( 'SSTATIC',      'http://localhost/trm/static/' );
}

define( 'HOST',   'localhost');
define( 'USERNAME', 'root');
define( 'PASSWORD', 'toor');
define( 'DATABASE', 'trm');
define('LOG_FILE', __DIR__.'/../error_log');
define('MAIL_API_KEY', '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');
