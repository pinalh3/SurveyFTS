<?php
    include('session.php'); 
    
    if(!isset($_SESSION['login_user'])){ 
    header("location: index.php"); // Redirecting To Home Page 
    }
    //las time activity on session and destroy session
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    //header("location: index.php");
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	//Regenerate session id
    if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
	} else if (time() - $_SESSION['CREATED'] > 60) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
	}
  ?>

<head>
	<meta charset="utf-8">
	<title>GPB Survey from the Sky</title>
	<link rel="stylesheet" type="text/css" href="../css/stylesuav2.css">
	<link rel="stylesheet" type="text/css" href="../css/stylesuav3.css">
	<link rel="icon" href="img/picture1.png" type="image/png" sizes="any">
</head>
<body>
	<!-- Primer encabezado -->
	<div class="row" id="container1">
		<div class="col-2 head1" id="izq">
			<img src="img/gpblogo2.svg" id="logo2">
		</div>
		<div class="col-8 head2" id="titulo">
			<h1>Survey From The Sky</h1>
		</div>
		<div class="col-2 head2" id="der">
			<img src="img/surveylogo.svg" id="survey">
		</div>
	</div>
	
	<!-- Nav bar -->
	<div class="row" id="container2">
		<div class="col-2" id="vacio">&nbsp;
		
		</div>
		<div class="col-10" id="navegador">
			<ul class="men1"> 
				<li><a href="">RAV</a>
					<ul class="smen1">
   						<li><a href="pdf/RAV_5.pdf">Rav 5</a></li>
		   				<li><a href="pdf/RAV_21.pdf">Rav 21</a></li>
		   				<li><a href="pdf/RAV_39.pdf">Rav 39</a></li>	
		   				<li><a href="pdf/RAV_45.pdf">Rav 45</a></li>	
		   				<li><a href="pdf/RAV_47.pdf">Rav 47</a></li>
		   				<li><a href="pdf/RAV_60.pdf">Rav 60</a></li>
		   				<li><a href="pdf/RAV_67.pdf">Rav 67</a></li>
		   				<li><a href="pdf/RAV_91.pdf">Rav 91</a></li>
		   				<li><a href="pdf/RAV_130.pdf">Rav 130</a></li>
		   				<li><a href="pdf/RAV_145.pdf">Rav 145</a></li>
		   				<li><a href="pdf/RAV_273.pdf">Rav 273</a></li>
		   				<li><a href="pdf/RAV_281.pdf">Rav 281</a></li>
   					</ul>	
				</li>
					
     
				<li><a href="">Emergency Numbers</a>
					<ul class="smen1">
   						<li><a href="pdf/RAV_5.pdf">ATC</a></li>
   					</ul>
				</li>
				<a class="men1" href="logout.php"><img src=../img/lgt.svg id="out">Logout</a>
			</ul>
		</div>
	</div>

	<!-- Cuerpo principal -->
	<div class="row" id="container3">
		<div class="col-2" id="menup">
			<div class="row" id=ipers>
				<img id="pers">
			</div>
			<div class="row" id="u">
				<p id="user"> <?php echo $login_session; ?> </p>
			</div>
			<div class="row" id="m">
				<ul class="men1">
					<li>
						<a href="">Flights</a>
					</li>
					<li>
						<a href="">Manteinance</a>
					</li>
					<li>
						<a href="">Inventory</a>
						<ul class="smen1">
							<li><a href="">UAV</a></li>
							<li><a href="">Batteries</a></li>
							<li><a href="">Equipment</a></li>
							<li><a href="">Vehicles</a></li>
							<li><a href="">Locations</a></li>
						</ul>
					</li>
					<li>
						<a href="">Crew</a>
					</li>
					<li>
						<a href="">Reports</a>
					</li>
					<li>
						<a href="">Incidents</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-10" id="">
			<div id="box">
			    <p>Menu2</p>
			</div>
			
			</form>
		</div>
	</div>
	<script src="photo.js"></script>

</body>