<?php 
	session_start();
	require __DIR__."/src/autoload.php";
	require __DIR__."/header.php";
	
?>

<body class="signup-page">
	<div class="page-header header-filter" filter-color="purple" style="background-image: url('../assets/img/bg7.jpg'); background-size: cover; background-position: top center;">
    	<div class="container">
			<div class="row">
    			<div class="col-md-10 col-md-offset-1">

					<div class="card card-signup">
                        <h2 class="card-title text-center">Register</h2>
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
								<form class="form" method="post" action="#">
									<div class="content">
										<div class="form-group label-floating is-empty">
											<label class="control-label">Username</label>
											<input type="text" name="uname" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Password</label>
											<input type="password" name="pass" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">First Name</label>
											<input type="text" name="fname" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Last Name</label>
											<input type="text" name="lname" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Date Of Birth</label>
											<input type="text" name="dob" class="datepicker form-control"  />
										</div>
										<div class="form-group label-static">
											<label class="control-label">Gender</label>
											<div class="radio" style="display: inline-block;">
												<label>
													<input type="radio" name="gender">
													Male
												</label>
											</div>
											<div class="radio" style="display: inline-block;">
												<label>
													<input type="radio" name="gender">
													Female
												</label>
											</div>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Email</label>
											<input type="email" name="email" class="form-control">
											<span class="material-input"></span>
										</div>
										<div class="form-group label-floating is-empty">
											<label class="control-label">Country</label>
											<input type="text" name="country" class="form-control">
											<span class="material-input"></span>
										</div>

										<div class="checkbox">
											<label>
												<input type="checkbox" name="optionsCheckboxes">
												I agree to the <a href="#something">terms and conditions</a>.
											</label>
										</div>
									</div>
									<div class="footer text-center">
										<input type="submit"  class="btn btn-primary btn-round" value="Get Started">
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