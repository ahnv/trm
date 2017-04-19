<?php
	session_start();
	require __DIR__."/src/autoload.php";
	if (isset($_SESSION['logged_in']) && !$_SESSION['logged_in']){
		header('Location: '.URL.'logout');
	}
	if ((new LoginHelper($db))->getCurrentStatus($_SESSION['user_id'])){
		switch ($_SESSION['status']) {
			case '0':	header("Location: ".URL."unverified");	break;
			case '1':	header("Location: ".URL."dashboard");	break;
			case '2':	break;
		}
	}
	$page = "Banned";
	require __DIR__."/header.php";
?>

<body class="login-page">
	<div class="page-header header-danger" style="background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form class="form" method="post" action="#">
							<div class="header header-danger text-center" style="">
								<h4 class="card-title">You have been banned</h4>
							</div>
							<div class="col-xs-10 col-xs-offset-1" style="margin-bottom: 25px;">
								<h3>You have been Banned. <br>If you think there has been a mistake, please contact on support@right.mail</h3>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>


<?php 
	require __DIR__."/footer.php";
?>