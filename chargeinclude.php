<!DOCTYPE html>
 <?php
    include ('con.php');
    include('session.php');
    include('chargeinsert.php');
    
    if(!isset($_SESSION['login_user'])){ 
    header("location: index.php"); // Redirecting To Home Page 
    }
    //las time activity on session and destroy session
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 120)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    //header("location: index.php");
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	//Regenerate session id
    if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
	} else if (time() - $_SESSION['CREATED'] > 120) {
    // session started more than 30 minutes ago
    session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
    $_SESSION['CREATED'] = time();  // update creation time
	} 
  ?>
<head>
	<meta charset="utf-8">
	<title>GPB Survey from the Sky</title>
	<!--<link rel="stylesheet" type="text/css" href="bootstrap.css">-->
	<link rel="stylesheet" type="text/css" href="../css/stylesuav5.css">
	<link rel="stylesheet" type="text/css" href="../css/stylesuav2.css">
	<link rel="stylesheet" type="text/css" href="../css/stylesheet6.css">
	<link rel="icon" href="img/picture1.png" type="image/png" sizes="any">
	<link rel="script" type="javascript" href="photo.js">
	
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
		<div class="col-8" id="navegador">
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
			</ul>
		</div>
		<div class="col-2" id="lgt">
			<section class="row">
				<section class="col-6 logt">
					<p><a class="logta" href="menu1.php"><img src="img/home.svg" class="out">&nbsp;&nbsp;Home</a></p>
				</section>
				<section class="col-6 logt">
					<p><a class="logta" href="logout.php"><img src="img/lgt.svg" class="out">&nbsp;&nbsp;Logout</a></p>
				</section>
			</section>
			
		</div>
	</div>

	<!-- Cuerpo principal -->
	<div class="row" id="container3">
	<div class="col-2" id="menup">
			<div class="row" id="ipers">
				<img id="pers">
			</div>
			<div class="row" id="u">
				<p id="user"><?php echo $login_session; ?></p>
			</div>
			<div class="row" id="m">
				<ul class="mn2">
					<li>
						<a href="flights.php">Flights</a>
					</li>
					<li>
						<a href="">Maintenance</a>
					</li>
					<li>
						<a href="">Inventory</a>
						<ul class="smen2">
							<li><a href="uav.php">UAV</a></li>
							<li><a href="batteries.php">Batteries</a></li>
							<li><a href="motors.php">Motors</a></li>
							<li><a href="servos.php">Servos</a></li>
							<li><a href="payloads.php">Payloads</a></li>
							<li><a href="consummables.php">Consumables</a></li>
							<li><a href="equipment.php">Equipment</a></li>
							<li><a href="vehicles.php">Vehicles</a></li>
							<li><a href="locations.php">Locations</a></li>
						</ul>
					</li>
					<li>
						<a href="crewfront.php">Crew</a>
					</li>
					<li>
						<a href="reports.php">Reports</a>
					</li>
					<li>
						<a href="incidents.php">Incidents</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-10" id="form1">
			<div class="col-11 borsupe" id="flights">
				<div class="topr">&nbsp;</div>
				<div class="topr">
					<p>CREW</p>
				</div>
				<div class="topr right">
					
				</div>
				
			</div>
			<div class="col-11 formcontainer" id="">
				<div class="err"><span ><?php echo $errorp; ?></span><br><br></div>
				
			    <form class="incform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
				    <div>
				    	<label class="label1">Battery Serial</label>&nbsp;
				        <select name="selectbatt" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent="SELECT * FROM batteries;";
				                    $result2=mysqli_query($conn, $sqlsent);
				                    $result2check = mysqli_num_rows($result2);
				    				
				    				if ($result2check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
	                			        
	                			           echo "<option class='tabd ".$row['batt_serial']."' value=".$row['batteries_id'].">".$row['batt_serial']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        </select>
				        &nbsp;&nbsp;
				        <label class="label1">Date of Charge</label>&nbsp;
				        <input type="date" name="chargedate" value="" class="input1" required>
				        &nbsp;&nbsp;
	                    <input type="number" name="voltbefore" value="" placeholder="Voltage Before Charge" class="input1" maxlength="7" required step="0.01">
	                    &nbsp;&nbsp;
	                    <input type="number" name="voltafter" value="" placeholder="Voltage After Charge" class="input1" required maxlength="7" required step="0.01">
	                    <br><br><br>
	                    <label class="label1">Charging Time</label>&nbsp;
	                    <input type="text" name="chargetime" value="" class="input1" maxlength="8" placeholder="HH:MM:SS" required>
	                    &nbsp;&nbsp;
	                    <input type="number" name="chargecurrent" value="" placeholder="Charging Current" class="input1" maxlength="7" required>
	                    &nbsp;&nbsp;
	                    <input type="number" name="chargereceived" value="" placeholder="Charge Received" class="input1" maxlength="7" required>
	                    <br><br>
	                    <label class="label1">Charged By</label>&nbsp;
	                    <select name="chargedby" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM crew;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['crew_id'].">".$row['first_name']." ".$row['middle_name']." ".$row['first_surname']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        </select>
	                    
	                    <section class="row">
	                    	<section class="col-2">
	                    		<label class="label1">Is it associated with a flight? wich one?</label>
	                    	
	                    	</section>
	                    	<section class="col-10">
	                    			<?php
				                    $sqlsent3="SELECT * FROM flightslog;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	echo "<datalist id='flight'>";
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['flights_id'].">".$row['flights_id']."</option>"; 
	                			        } 
	                			        echo "</datalist>";
	                			    }
	                			    ?>
	                			    <input list="flight" class="input1" name="flight">
	                    	</section>
	                    	
	                    </section>
	                    
	                    <br><br>
	                    <input type="submit" class="include" name="submit" value="Submit">
	                    
                    </div>
			    </form>	
			    		
			    
			    	
			    	
			    	
				
				
			
			</div>
		</div>
	</div>
	<script src="photo.js" ></script>
	
</body>