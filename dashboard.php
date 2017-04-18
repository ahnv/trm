<?php
	session_start();
	require __DIR__."/src/autoload.php";
	if (isset($_SESSION['logged_in']) && !$_SESSION['logged_in']){
		header('Location: '.URL.'logout');
	}
	if (isset($_SESSION['status'])){
		switch ($_SESSION['status']) {
			case '0': header("Location: ".URL."unverified");	break;
			case '1':	break;
			case '2': header("Location: ".URL."banned");	break;
		}
	}
?>
