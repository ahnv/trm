<?php 
	session_start();
	require __DIR__."/src/autoload.php";
	if (!isset($_SESSION['logged_in']) && !$_SESSION['logged_in']){
		header('Location: '.URL);
	}
	if ((new LoginHelper($db))->getCurrentStatus($_SESSION['user_id'])){
		switch ($_SESSION['status']) {
			case '0':	break;
			case '1':	header("Location: ".URL."dashboard");	break;
			case '2':	header("Location: ".URL."banned");	break;
		}
	}
	if (isset($_POST['submit']) && isset($_POST['token'])){
		(new registerHelper($db))->verifyRegistration($_SESSION['user_id'],$_POST['token']);
	}
	$page = "Verify Your Account";
	require __DIR__."/header.php";
?>

<body class="login-page">
	<div class="page-header header-filter" style="background-image: url('static/img/bg.jpg'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form class="form" method="post" action="#">
							<div class="header header-primary text-center">
								<h4 class="card-title">Verify Your Account</h4>
							</div>
							<?php if (isset($msg)): ?>
							<div class="alert alert-danger">
								<span><?php echo $msg; ?></span>
							</div>
							<?php endif; ?>
							<div class="col-xs-10 col-xs-offset-1">

								<div class="form-group label-floating is-filled">
									<label class="control-label">Username</label>
									<input required type="text" disabled name="uname" class="form-control" value="<?php echo $_SESSION['user'] ?>">
									<span class="material-input"></span>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Token</label>
									<input required type="text" name="token" class="form-control">
									<span class="material-input"></span>
								</div>
							</div>
							<div class="footer text-center">
								<input type="submit" class="btn btn-primary btn-simple btn-wd btn-lg" name="submit">
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