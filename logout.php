<?php 
session_start();
session_destroy();
require __DIR__.'/src/autoload.php';
header("Location: ".URL);