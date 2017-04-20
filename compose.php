<?php
	session_start();
	require __DIR__."/src/autoload.php";
	if (!isset($_SESSION['logged_in']) && !$_SESSION['logged_in']){
		header('Location: '.URL.'logout');
	}
	if ((new LoginHelper($db))->getCurrentStatus($_SESSION['user_id'])){
		switch ($_SESSION['status']) {
			case '0':	header("Location: ".URL."unverified");	break;
			case '1':	break;
			case '2':	header("Location: ".URL."banned");	break;
		}
	}
	$page = "Compose";
	require 'header.php';
	if (isset($_POST['submit']) && isset($_POST['to']) && isset($_POST['subject']) && isset($_POST['body'])){
		if ((new MailerHelper($db))->sendMail($_POST['to'], $_POST['subject'], $_POST['body'])){
			$msg = "Mail Successfully Sent.";
		}else{
			$msg = "Mail Could not be sent. Please Check Email Address."
		}
	}
?>
	<body>
		<?php require 'nav.php'; ?>
		<div class="container">
				<div class="card" style="padding: 50px; min-height: 80vh;">
					<?php if (isset($msg)): ?>
					<div class="alert alert-warning" style="margin-left: -50px; margin-right: -50px;"><?php echo $msg; ?></div>
					<?php endif; ?>
					<form action="#" method="post">
						<div class="form-group label-floating is-empty">
							<label class="control-label">To</label>
							<input required type="text" name="to" class="form-control">
							<span class="material-input"></span>
						</div>
						<div class="form-group label-floating is-empty">
							<label class="control-label">Subject</label>
							<input required type="text" name="subject" class="form-control">
							<span class="material-input"></span>
						</div>
						<div class="form-group label-floating is-empty">
							    <label class="control-label"> Compose Email</label>
							    <textarea class="form-control" name="body" rows="12"></textarea>
	                    <span class="material-input"></span></div>
	                    <div class="footer text-center">
								<input type="submit" class="btn btn-primary btn-simple btn-wd btn-lg" name="submit" value="Send Mail">
						</div>
					</form>
				</div>
		</div>
<?php 
	require 'footer.php';
?>