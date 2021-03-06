<!DOCTYPE html>
 <?php
    include_once 'con.php';
    include('session.php');
    include('flightsinsert.php');
    
    if(!isset($_SESSION['login_user'])){ 
    header("location: index.php"); // Redirecting To Home Page 
    }
    //las time activity on session and destroy session
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1440)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    //header("location: index.php");
	}
	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

	//Regenerate session id
    if (!isset($_SESSION['CREATED'])) {
    $_SESSION['CREATED'] = time();
	} else if (time() - $_SESSION['CREATED'] > 1440) {
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
					<p>NEW FLIGHT</p>
				</div>
				<div class="topr right">
					
				</div>
				
			</div>
			<div class="col-11 formcontainer" id="">
				<div class="err"><span ><?php echo "$errorp <br> $relalert <br> $releasemsg <br><br><br>"; ?></span></div>
				
			    <form class="incform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
				    <div>
				    	
				         
				        &nbsp;&nbsp;
				        <label class="label1">Date of Flight</label>&nbsp;
				        <input type="date" name="fdate" value="" class="input1" required>
				        &nbsp;&nbsp;
	                    <label class="label1">Start Time</label>&nbsp;
	                    <input type="text" name="start_time" value="" class="input1" maxlength="8" placeholder="HH:MM:SS" required>
	                    &nbsp;&nbsp;
	                    <label class="label1">End Time</label>&nbsp;
	                    <input type="text" name="end_time" value="" class="input1" maxlength="8" placeholder="HH:MM:SS" required>
	                    &nbsp;&nbsp;
	                    <label class="label1">Time of Flight</label>&nbsp;
	                    <input type="text" name="time_flight" value="" class="input1" maxlength="8" placeholder="HH:MM:SS" required>
	                    
	                    <br><br><br><br>
	                    &nbsp;&nbsp;
	                    <label class="label1">UAV</label>&nbsp;
	                    <select name="uav" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM uav;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['uav_id'].">".$row['uav_serial']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        </select>
				         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				        <label class="label1">Battery</label>&nbsp;
	                    <select name="battery" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM batteries;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['batteries_id'].">".$row['batt_serial']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        </select>
				        
				         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				        <label class="label1">Payload</label>&nbsp;
	                    <select name="payload" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM payloads;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['payload_id'].">".$row['pay_serial']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        </select>
				         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                    <label class="label1">Antenna</label>&nbsp;
	                    <select name="antenna" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM antenna;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['antenna_id'].">".$row['antenna']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        </select>
				        <br><br><br><br>
				        &nbsp;&nbsp;
	                    <label class="label1">Battery Usage</label>&nbsp;
	                    <input type="text" name="battery_usage" value="" class="input1" maxlength="4" placeholder="Volts" required>&nbsp;&nbsp;
	                    <label class="label1">Voltage Drop</label>&nbsp;
	                    <input type="text" name="voltage_drop" value="" class="input1" maxlength="4" placeholder="Volts" required>
				        <br><br><br><br>
				        
				        
				        &nbsp;&nbsp;
	                    <label class="label1">Windspeed</label>&nbsp;
	                    <input type="text" name="windspeed" value="" class="input1" maxlength="2" placeholder="m/s" required>
	                    &nbsp;&nbsp;
	                    <label class="label1">Temperature</label>&nbsp;
	                    <input type="text" name="flight_temperature" value="" class="input1" maxlength="3" placeholder="ºC" required>
	                     &nbsp;&nbsp;
	                    <label class="label1">Weather Condition</label>&nbsp;
	                    <select name="weather_condition" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM weather;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['wconditions_id'].">".$row['weather_name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
				        <br><br><br><br>
				         &nbsp;&nbsp;
	                    <label class="label1">Operations Area</label>&nbsp;
	                    <select name="operations_area" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM operation_area;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['operation_area_id'].">".$row['operation_area_name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
				          &nbsp;&nbsp;
	                    <label class="label1">Operations Objective</label>&nbsp;
	                    <select name="operations_objective" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM objective;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['opeobj_id'].">".$row['ope_name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
				        &nbsp;&nbsp;
	                    <label class="label1">Max Height Reached</label>&nbsp;
	                    <input type="text" name="max_height" value="" class="input1" maxlength="4" placeholder="mts" required>
	                    
	                     <br><br><br><br>
				         &nbsp;&nbsp;
	                    <label class="label1">Launching Point</label>&nbsp;
	                    <select name="launchingp" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM locations;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['locations_id'].">".$row['locations_name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
	                    &nbsp;&nbsp;
	                    <label class="label1">Landing Point</label>&nbsp;
	                    <select name="landingp" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM locations;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['locations_id'].">".$row['locations_name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
	                    
	                       <br><br><br><br>
				         &nbsp;&nbsp;
	                    <label class="label1">Operator</label>&nbsp;
	                    <select name="operator" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM crew;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['crew_id'].">".$row['first_name']." ".$row['first_surname']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
	                    &nbsp;&nbsp;
	                    <label class="label1">Technic</label>&nbsp;
	                    <select name="technic" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM crew;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['crew_id'].">".$row['first_name']." ".$row['first_surname']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
	                    
	                      <br><br><br><br>
				         &nbsp;&nbsp;
	                    <label class="label1">Parachute Responsible</label>&nbsp;
	                    <select name="parachuter" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM crew;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['crew_id'].">".$row['first_name']." ".$row['first_surname']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
	                    &nbsp;&nbsp;
	                    <label class="label1">UAV Responsible</label>&nbsp;
	                    <select name="uavresp" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM crew;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['crew_id'].">".$row['first_name']." ".$row['first_surname']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
				        
				        </select>
				        
				        <br><br><br>
	                    <label class="label1">Release Changed Before Flight</label>&nbsp;
	                    <select name="releasech" class="input1" required>
				            <option value"" class="tabb"></option>
                            <option value"0" class="tabb">No</option>
                            <option value"1" class="tabb">Yes</option>
				        
				        </select>
	                    &nbsp;&nbsp;&nbsp;
	                    <label class="label1">Release Activated on Landing</label>&nbsp;
	                    <select name="releaseact" class="input1" required>
				            <option value"" class="tabb"></option>
                            <option value"0" class="tabb">No</option>
                            <option value"1" class="tabb">Yes</option>
				        
				        </select>
	                    
	                    
	                    <br><br><br><br>
	                    &nbsp;&nbsp;
	                    <label class="label1">Comments</label>&nbsp;
	                    <input type="text" name="comments" value="" class="input1" maxlength="255" placeholder="Comments">
	                    
	                    <br><br><br><br>
	                    
	                    &nbsp;&nbsp;<p class="alert">If there are any damages infringed to the UAV or any component, please fill the damages bellow</p>
	                    <br><br>
	                    &nbsp;&nbsp;
	                    <label class="label1">Damage Type</label>&nbsp;
	                    <select name="damaget" class="input1">
				            <option value"0" class="tabb"></option>
                                    <?php
				                    $sqlsent3="SELECT * FROM damage_type;";
				                    $result3=mysqli_query($conn, $sqlsent3);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['damage_type_id'].">".$row['damage_name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
	                	</select>
	                	<br><br><br><br>
	                    &nbsp;&nbsp;
	                    <label class="label1">Damage Description</label>&nbsp;
	                    <input type="text" name="damadesc" value="" class="input1" maxlength="255" placeholder="Describe the damages">
				        <br><br><br><br>
				        
				        
				        <br><br>
	                   
	                   
	                    <input type="submit" class="include" name="submit" value="Submit">
	                    

			    </form>	
			    		
			    
			    	
			    	
			    	
				</div>
				
			
			</div>
		</div>
	</div>
	<script src="photo.js" ></script>
	
</body>