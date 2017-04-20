<nav class="navbar navbar-rose">
<div class="container">

<div class="navbar-header">
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
<a class="navbar-brand" href="dashboard">The Right Mail</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<ul class="nav navbar-nav">
<li <?php if ($page == "Dashboard"): ?> class="active" <?php endif; ?> >
<a href="dashboard">Dashboard</a>
</li>
<li>
<a href="compose">Compose</a>
</li>

</ul>
<ul class="nav navbar-nav navbar-right">
<li>
<a href="logout">Logout</a>
</li>

</ul>


</div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>