<?php

require __DIR__.'/config.php';

spl_autoload_register(function($className) {
	$file = __DIR__ . '/classes/' . strtolower($className) . '.class.php';
	if(file_exists($file))  require $file;
});

$db = (new DB())->getInstance();