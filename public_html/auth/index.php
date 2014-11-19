<?php include 'session.php' ?>

<!doctype html>
<html>
<head>
  <title>SSTS</title> 

  <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="navbar-fixed-top.css" rel="stylesheet">
</head>
<body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
       <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
           </button>
           <img class="navbar-brand" src="../ssts_logo.png" width="50" height="30"/>
       </div>
       <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
             <li class="active"><a href="index.php">Home</a></li>
             <li><a href="">Portfolios</a></li>
             <li><a href="">Competitions</a></li>
			 <li><a href="stocks.php">Stocks</a></li>
             <li><a href="">What-If</a></li>
         </ul>
	 <ul class="nav navbar-nav navbar-right">
	    <li class="navbar-text"><?php echo 'Welcome ' . $_SESSION['username'];?></li>
		<li><a href="">Settings</a></li>
	    <li><form method="post" action="logout.php">
	       <button type="submit" value="Log out" class="btn btn-default navbar-btn">Log out</button>
	       </form></li>
	 </ul>
      </div><!--/.nav-collapse -->
   </div>
</nav>

<div class="wrapper">

<div class="panel panel-default" id="home-activestats">
  <div class="panel-heading">
     <h3 class="panel-title">Active Portfolio Stats</h3>
  </div>
  <div class="panel-body">
    Placeholder 
  </div>
</div>

<div class="panel panel-default" id="home-leaderboard">
   <div class="panel-heading">
      <h3 class="panel-title">Leaderboard</h3>
   </div>
   <div class="panel-body">
      Placeholder
   </div>
</div>

<div class="panel panel-default" id="home-compbox">
   <div class="panel-heading">
      <h3 class="panel-title">Your Competitions</h3>
   </div>
   <div class="panel-body">
      Placeholder
   </div>
</div>

</div>

<footer class="footer">
   <div class="container">
      <p class="text-muted"><small>Created by Team UG-2</small></p>
	  <p class="text-muted"><small><a href="">About</a></small></p>
   </div>
</footer>

</div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../dist/js/bootstrap.min.js"></script>
</body>
</html>