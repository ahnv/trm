<?php 
	session_start();
	require __DIR__."/src/autoload.php";
	require __DIR__."/header.php";
?>

<body class="landing-page">
    <nav class="navbar navbar-danger navbar-transparent navbar-absolute">
    	<div class="container">
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a class="navbar-brand">The Right Mail</a>
        	</div>
    	</div>
    </nav>


    <div class="page-header header-filter" data-parallax="active" style="background-image: url('static/img/bg8.jpg');">
        <div class="container">
            <div class="row">
				<div class="col-md-6">
					<h1 class="title">The Right Mail.</h1>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h4>
                    <br />
                    <a href="login" class="btn btn-success btn-raised btn-lg">
						Sign In 
					</a>
                    <a href="register" class="btn btn-danger btn-raised btn-lg">
						Register Now
					</a>
				</div>
            </div>
        </div>
    </div>

	<div class="main main-raised">
		<div class="container">
	       	<div class="section text-center">
                <h2 class="title">Here is our team</h2>

				<div class="team">
					<div class="row">
						<div class="col-md-6">
							<div class="card card-profile card-plain">
								<div class="col-md-5">
									<div class="card-image">
										<a href="#pablo">
											<img class="img" src="../assets/img/faces/card-profile1-square.jpg" />
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="content">
										<h4 class="card-title">Alec Thompson</h4>

										<p class="card-description">
											Don't be scared of the truth because we need to restart the human foundation in truth...
										</p>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card card-profile card-plain">
								<div class="col-md-5">
									<div class="card-image">
										<a href="#pablo">
											<img class="img" src="../assets/img/faces/card-profile6-square.jpg" />
										</a>
									</div>
								</div>
								<div class="col-md-7">
									<div class="content">
										<h4 class="card-title">Kendall Andrew</h4>

										<p class="card-description">
											Don't be scared of the truth because we need to restart the human foundation in truth...
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
	</div>
    <footer class="footer">
        <div class="container">
            <div class="copyright pull-right">
                &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i>
            </div>
        </div>
    </footer>

<?php 
	require __DIR__."/footer.php";
?>