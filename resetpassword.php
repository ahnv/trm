<?php 
	session_start();
	require __DIR__."/src/autoload.php";
	if (isset($_POST['submit']) && isset($_POST['uname']) && isset($_POST['token']) && isset($_POST['pass'])){
		$res = (new LoginHelper($db))->resetPassword($_POST['uname'],$_POST['token'],$_POST['pass']);
		switch ($res) {
				case true:	$msg="Your Password has successfully been updated.";	break;
				case false:	$msg="Some Error has Occured.";	break;
			}	
	}
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
		header('Location: '.URL.'dashboard');
	}
	$page = "Sign In";
	require __DIR__."/header.php";
?>

<body class="login-page">
	<div class="page-header header-filter" style="background-image: url('static/img/bg2.jpg'); background-size: cover; background-position: top center;">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-sm-offset-3">
					<div class="card card-signup">
						<form class="form" method="post" action="#">
							<div class="header header-info text-center">
								<h4 class="card-title">Reset Your Password</h4>
							</div>
							<?php if (isset($msg)): ?>
							<div class="alert alert-danger">
								<span><?php echo $msg; ?></span>
							</div>
							<?php endif; ?>
							<div class="col-xs-10 col-xs-offset-1">
								<div class="form-group label-floating is-empty">
									<label class="control-label">Username</label>
									<input required type="text" name="uname" class="form-control">
									<span class="material-input"></span>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">Token</label>
									<input required type="type" name="token" class="form-control">
									<span class="material-input"></span>
								</div>
								<div class="form-group label-floating is-empty">
									<label class="control-label">New Password</label>
									<input required type="password" name="pass" class="form-control">
									<span class="material-input"></span>
								</div>
							</div>
							<div class="footer text-center">
								<input type="submit" class="btn btn-info btn-simple btn-wd btn-lg" name="submit">
								<a href="login" class="btn btn-info btn-simple btn-wd btn-lg">Login</a>
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