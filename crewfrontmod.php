<!DOCTYPE html>
 <?php
    include_once 'con.php';
    include('session.php');
    
    
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
	<link rel="script" type="javascript" href="state.js">
	
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
			    
			    <!--crew information-->
				<?php
				    $special = 'htmlspecialchars($_SERVER["PHP_SELF"]);';
	                $errorp = ''; // Variable To Store Error Message 
                    if (isset($_POST['submit'])) 
                    { 
                    $crewid= $_POST["view1"];
                    
                    //reemplazar por funciones//
                    
                    $sqlsent="SELECT * FROM crew where crew_id=$crewid;";
                    $result1=mysqli_query($conn, $sqlsent);
			        $result1check = mysqli_num_rows($result1);
                    
                    	if ($result1check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result1))
	                			        {
	                			        $citycode = $row['city_id'];
	                			        $sqlsent2="SELECT * FROM city where city_id=$citycode;";
                                        $result2=mysqli_query($conn, $sqlsent2);
			                            $result2check = mysqli_num_rows($result2);
                    
                    	                if ($result2check > 0)
	                			        {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
	                			        $cityname = $row['name'];
	                			        $municipcode = $row['municipality_id'];
	                			        $sqlsent3="SELECT * FROM municipality where municipality_id=$municipcode;";
                                        $result3=mysqli_query($conn, $sqlsent3);
			                            $result3check = mysqli_num_rows($result3);
                    
                    	                if ($result3check > 0)
	                			        {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        $municipname = $row['name'];
	                			        $stateid = $row['estate_id'];
	                			        
	                			        $sqlsent4="SELECT * FROM estate where estate_id=$stateid;";
                                        $result4=mysqli_query($conn, $sqlsent4);
			                            $result4check = mysqli_num_rows($result4);
			                            
			                            if ($result4check > 0)
	                			        {
	                			    	while ($row = mysqli_fetch_assoc($result4))
	                			        {
	                			        $statename = $row['name'];
	                			        
	                	  
                    $sqlsent="SELECT * FROM crew where crew_id=$crewid;";
                    $result1=mysqli_query($conn, $sqlsent);
			        $result1check = mysqli_num_rows($result1);
                    
                    	if ($result1check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result1))
	                			        {
	                			        
	                			           echo "<form class='incform' action='<?php echo ".$special."?>' method='post'>
				                           <section>
				                           <section class='row'>
				                        		<section class='col-2'><img src='../img/".$row['dni'].".jpg' alt='no encontrada' class='crewimg'>
				                        		</section>
				                        		<section class='col-10'>
				                        			<section class='row sepa'>
				                        				<section class='col-2'><label>DNI</label>
				                        				</section>
				                        				<section class='col-4'><input type='text' name='dni' value='".$row['dni']."' placeholder='Dni' class='input1' maxlength='10'>
				                        				</section>
				                        				<section class='col-2'><label>Birth Date</label></section>
				                        				<section class='col-4'><input type='date' name='birthdate' value='".$row['birthdate']."' placeholder='Birthdate' class='input1'>
				                        				</section>
				                        			</section>
				                        			<section class='row sepa'>
				                        	            <section class='col-2'><label>Firstname</label>
				                        	            </section>
				                        	            <section class='col-4'><input type='text' name='firstname' value='".$row['first_name']."' placeholder='First Name' class='input1' maxlength='20'>
				                        	            </section>
				                        	            <section class='col-2'><label>Middlename</label>
	                                    				</section>
	                                    				<section class='col-4'><input type='text' name='secondname' value='".$row['middle_name']."' placeholder='Second Name' class='input1' maxlength='20'>
	                                    				</section>
	                                    			</section>
	                                    			<section class='row sepa'>
	                                    				<section class='col-2'><label>First Surname</label>
	                                    				</section>
	                                    				<section class='col-4'><input type='text' name='firstsurname' value='".$row['first_surname']."' placeholder='First Surname' class='input1' maxlength='20'>
	                                    				</section>
	                                    				<section class='col-2'><label>Second Surname</label>
	                                    				</section>
	                                    				<section class='col-4'><input type='text' name='secondsurname' value='".$row['second_surname']."' placeholder='Second Surname' class='input1' maxlength='20'>
	                                    				</section>
	                                    			</section>
	                                    		</section>
	                                       </section>
	                                       <section class='row'>
	                                    		<section class='col-2'>
	                                    		</section>
	                                    		<section class='col-10'>
	                                    			<section class='row sepa'>
	                                    				<section class='col-2'><label>Estate</label></section>
	                                    				<section class='col-10'><input type='text' name='state' value='".$statename."' placeholder='State' class='input1' maxlength='20'>
	                                    				</section>
	                                    			</section>
	                                    		</section>
	                                       </section>
	                                       <section class='row'>
	                                    		<section class='col-2'>
	                                    		</section>
	                                    		<section class='col-10'>
	                                    			<section class='row sepa'>
	                                    				<section class='col-2'><label>Municipality</label></section>
	                                    				<section class='col-10'><input type='text' name='municipality' value='".$municipname."' placeholder='Municipality' class='input1' maxlength='20'>
	                                    				</section>
	                                    			</section>
	                                    		</section>
	                                       </section>
	                                       <section class='row'><p class='cent'>Address</p>
	                                       </section>
	                                       <section class='row'>
	                                    		<section class='col-2'>
	                                    		</section>
	                                    		<section class='col-10'>
	                                    			<section class='row sepa'>
	                                    				<section class='col-2'><label>Address</label>
	                                    				</section>
	                                    				<section class='col-10'><input type='text' name='address' value='".$row['address']."' placeholder='Address' class='input1' size='80%' maxlength='100'>
	                                    				</section>
	                                    			</section>
	                                    		</section>
	                                       </section>	
	                                       <section class='row'>
	                                    		<section class='col-2'>
	                                    		</section>
	                                    		<section class='col-10'>
	                                    			<section class='row sepa'>
	                                    				<section class='col-2'><label>City</label>
	                                    				</section>
	                                    				<section class='col-10'><input type='text' name='city' value='".$cityname."' placeholder='City' class='input1' maxlength='20'>
	                                    				</section>
	                                    			</section>
	                                    		</section>
	                                       </section>
	                                       <section class='row'>
	                                    		<section class='col-2'>
	                                    		</section>
	                                    		<section class='col-10'>
	                                    			<section class='row sepa'>
		                                    			<section class='col-2'><label>Emergency Contact</label>
		                                    			</section>
		                                    			<section class='col-10'><input type='text' name='emergencyc' value='".$row['emergency_cont']."' placeholder='Emergency contact' class='input1' maxlength='30'>
		                                    			</section>
		                                    		</section>
		                                    	</section>
		                                   </section>
	                                       <section class='row'>
	                                    		<section class='col-2'>
	                                    		</section>
	                                    		<section class='col-10'>
	                                    			<section class='row sepa'>
	                                    				<section class='col-2'></section>
	                                    				<section class='col-10'><input type='submit' class='include' name='modify' value='Modify'>
	                                    				</section>
	                                    			</section>
	                                    		</section>
	                                       </section>
	                                       </section></form>	";
	                			        } }}}}}}}}
	                			    }
                    }
			    		?>
			    		
			   <span><?php echo "$errorp"; ?></span>
			    	
			    	
			    <!-- CREW LICENCE border -->	
				</div>
				<div class='col-11 borsupe' id='flights'>
				<div class='topr'>&nbsp;</div>
				<div class='topr'>
					<p>LICENCE</p>
				</div>
				<div class='topr right'>
					
				</div>
				
			    </div>
			    
			    <div class='col-11 formcontainer' id=''>
			    
			    <?php
			    	
			    	//$special = 'htmlspecialchars($_SERVER["PHP_SELF"]);';
	                //$errorp = ''; // Variable To Store Error Message 
                    if (isset($_POST['submit'])) 
                    { 
                    $crewid= $_POST["view1"];
                    
			    
                    $sqlsentl="SELECT * FROM licence where crew_id=$crewid;";
                    
                    $resultl=mysqli_query($conn, $sqlsentl);
			        $resultlcheck = mysqli_num_rows($resultl);
                    
                    	if ($resultlcheck > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($resultl))
	                			        {
			    						echo "<form class='incform' action='<?php echo ".$special."?>' method='post'>" ;
				                        echo "<div>";
				                        echo "<input type='text' name='licence' value='".$row['number']."' placeholder='Licence Number' class='input1' maxlength='10'><br><br>";
				                        echo "<input type='text' name='expirationdate' value='".$row['expiration_date']."' placeholder='Expiration Date' class='input1' maxlength='20'><br><br>";
				                        //echo "<input type='submit' class='include' name='modifyl' value='Modify'>";
	                                    //echo "</div></form>	";
	                			        }}
	                			        
	                			        
	            	$sqlsentm = "SELECT * FROM medcheck where crew_id=$crewid;";  
	            	
	            	$resultm=mysqli_query($conn, $sqlsentm);
			        $resultmcheck = mysqli_num_rows($resultm);
                    
                    	if ($resultmcheck > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($resultm))
	                			        {
			    						/*echo "<form class='incform' action='<?php echo ".$special."?>' method='post'>" ;*/
				                        echo "<div>";
				                        echo "<input type='text' name='medcheck number' value='".$row['number']."' placeholder='Medcheck Number' class='input1' maxlength='10'><br><br>";
				                        echo "<input type='text' name='expirationdate' value='".$row['expiration_date']."' placeholder='Medical Expiration Date' class='input1' maxlength='20'>&nbsp&nbsp";
				                        echo "<input type='text' name='expirationdate' value='".$row['allergies']."' placeholder='Allergies' class='input1' maxlength='20'>&nbsp&nbsp";
				                        echo "<input type='text' name='blodtype' value='".$row['blood_type']."' placeholder='Blood Type' class='input1' maxlength='20'>&nbsp&nbsp";
				                        echo "<input type='submit' class='include' name='modifyl' value='Modify'>";
	                                    echo "</div></form>	";
	                			        }}
                    }
			     ?>
			    </div>
			    
			</div>
		</div>
	
	<script src="photo.js" ></script>
	
	</body>
	