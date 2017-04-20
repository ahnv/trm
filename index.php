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
        <div class="container" style="position: fixed; bottom: 20px; right: 10px">
            <div class="copyright pull-right">
                &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by Abhinav Dhiman
            </div>
        </div>
    </div>

<?php 
	require __DIR__."/footer.php";
?>