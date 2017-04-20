<?php 
	session_start();
	require __DIR__."/src/autoload.php";
	$page = "Register";
	require __DIR__."/header.php";
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
		header('Location: '.URL.'/dashboard');
	}
	if (isset($_POST['submit']) && 
		isset($_POST['uname']) && 
		isset($_POST['pass']) && 
		isset($_POST['fname']) && 
		isset($_POST['lname']) && 
		isset($_POST['dob']) && 
		isset($_POST['gender']) && 
		isset($_POST['email']) && 
		isset($_POST['country'])){
		$res = (new registerHelper($db))->register($_POST['uname'], $_POST['pass'], $_POST['fname'], $_POST['lname'], $_POST['dob'], $_POST['gender'], $_POST['email'], $_POST['country']);
		switch ($res) {
			case '1': $message = "Successfully Registered! Please Login."; break;
			case '0': $message = "Registration Unsuccessful. Please Try Again."; break;
			case '-1': $message = "Username or email already exists."; break;
			case '-2': $message = "Form not complete."; break;
			case '-3': $message = "Some Error Has Occured. Please Try Again Later."; break;
		}
	}
?>

<body class="signup-page">
	<div class="page-header header-filter" filter-color="purple" style="background-image: url('static/img/bg7.jpg'); background-size: cover; background-position: top center;">
    	<div class="container">
			<div class="row">
    			<div class="col-md-10 col-md-offset-1">
					<div class="card card-signup">
                        <h2 class="card-title text-center">Register</h2><?php if (isset($res)): ?>

                      	<div class="alert alert-<?php echo ($res == 1)?'success':'danger'; ?>">
                    		<span><?php echo $message ?></span>
                    	</div><?php endif; ?>

                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
								<form class="form" method="post" action="#">
									<div class="content">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Username</label>
											<input required type="text" name="uname" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Password</label>
											<input required type="password" name="pass" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">First Name</label>
											<input required type="text" name="fname" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Last Name</label>
											<input required type="text" name="lname" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-static">
											<label class="control-label">Date Of Birth</label>
											<input type="text" name="dob" class="datepicker form-control"  />
										</div>
										<div class="form-group label-static">
											<label class="control-label">Gender</label>
											<div class="radio" style="display: inline-block;">
												<label>
													<input required type="radio" name="gender" value="m">
													Male
												</label>
											</div>
											<div class="radio" style="display: inline-block;">
												<label>
													<input required type="radio" name="gender" value="f">
													Female
												</label>
											</div>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Email</label>
											<input required type="email" name="email" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Country</label>
											<input required type="text" name="country" class="form-control">
											<span class="material-input"></span>
										</div>

										<div class="checkbox">
											<label>
												<input required type="checkbox" name="terms">
												I agree to the <a href="#something">terms and conditions</a>.
											</label>
										</div>
									</div>
									<div class="footer text-center">
										<input type="submit"  class="btn btn-primary btn-round" value="Get Started" name="submit">
									</div>
								</form>
                            </div>
                        </div>
                	</div>

                </div>
            </div>
		</div>

<?php 
	require __DIR__."/footer.php";
?>