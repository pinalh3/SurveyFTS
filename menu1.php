<!DOCTYPE html>
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
			<div class="row" id=ipers>
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
				<p>Welcome</p>
			</div>
			<div class="col-11 formcontainer" id="">
				
				<br>
				<?php 
				
					$sqlsentuav="SELECT *
										FROM uav 
										JOIN status 
										WHERE uav.status_id=status.status_id
										ORDER BY uav_id
    									";
    			            $resultuav=mysqli_query($conn, $sqlsentuav);
    			            
    			            
    			            
    			            
    			            $resultcheckuav = mysqli_num_rows($resultuav); 
                			 if ($resultcheckuav > 0)
                            {
                            	
                                while ($row = mysqli_fetch_assoc($resultuav))
                                {
                                	$uavserial=$row['uav_serial'];
                                	$uav=$row['uav_id'];
                                	$status=$row['name'];
                                	
                                		//date,time,releasecount
                                		
                                		   $sqlsentdate="SELECT MAX( fdate ) AS fecha
				    									FROM flightslog AS b
				    									WHERE b.uav_id =$uav";
				    			            $resultdate=mysqli_query($conn, $sqlsentdate);
				    			            
				    			            
				    			            
				    			            
				    			            $resultcheckdate = mysqli_num_rows($resultdate); 
				                			 if ($resultcheckdate > 0)
				                            {
				                            	
				                                while ($row1 = mysqli_fetch_assoc($resultdate))
				                                {
				                                	$maxdate=$row1['fecha'];
				                                	
				                                }
				                                
				                            }
				                            
				                            //time
				                            
				                            $sqlsenttime="SELECT MAX( start_time ) AS tiempo
				    									FROM flightslog AS a
				    									WHERE a.uav_id =$uav
				    									AND a.fdate = '$maxdate'";
				    						
				                            $resulttime=mysqli_query($conn, $sqlsenttime);
				    			            
				    			            
				    			            $resultchecktime = mysqli_num_rows($resulttime); 
				                			 if ($resultchecktime > 0)
				                            {
				                            	
				                                while ($row2 = mysqli_fetch_assoc($resulttime))
				                                {
				                                	$maxtime=$row2['tiempo'];
				                                	
				                                }
				                                
				                            }
				                            
				                            
				                            //release
				                            
				                            $sqlsentrel="SELECT *
				    									FROM flightslog AS a
				    									JOIN release_control AS b 
				    									WHERE a.uav_id =$uav
				    									AND a.fdate = '$maxdate'
				    									AND a.start_time = '$maxtime'
				    									AND a.flights_id=b.flights_id"
				    									;
				    						
				    						$resultrel=mysqli_query($conn, $sqlsentrel);
				    			            
				    			           
				    			            $resultcheckrel = mysqli_num_rows($resultrel); 
				    			            
				                			 if ($resultcheckrel > 0)
				                            {
				                                while ($row3 = mysqli_fetch_assoc($resultrel))
				                                {
				                                  $count=$row3['release_count'];  
				                                  $releaseafter=$row3['release_after'];
				                                  $lastflight=$row3['flights_id'];
				                                  
				                                }
				                                if($count>=5)
				                                {
				                                    $relalert="Release must be changed";
				                                    //alert
				                                }
				                            }
				                            
				                            
				                    		$sqlsenttotime="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time_flight))) AS hours FROM flightslog WHERE uav_id=$uav";
                                		
                                			$resulttime=mysqli_query($conn, $sqlsenttotime);
				    			            
				    			           
				    			            $resultcheckttime = mysqli_num_rows($resulttime); 
				    			            
				                			 if ($resultcheckttime > 0)
				                            {
				                                while ($row5 = mysqli_fetch_assoc($resulttime))
				                                {
				                                  $totaltime=$row5['hours'];  
				                                 
				                                }
				                               
				                            }
                                	
                                			//Cantidad de vuelos
                                			
                                			$sqlsentvuel="SELECT * FROM flightslog WHERE uav_id=$uav";
                                		
                                			$resultvuel=mysqli_query($conn, $sqlsentvuel);
				    			            
				    			           
				    			            $resultcheckvuel = mysqli_num_rows($resultvuel); 
                                	
                                	echo "<section class='row pres1'>
					    				<section class='col-2 utitle'><p>UAV--$uavserial</p><p> $status</p></section>
							    		<section class='col-10'>
							    			<section class='row pad'>
							    				<section class='col-3'>
							    					<section class='display'><p>Last Flight</p><p>$maxdate at $maxtime</p></section>
							    				</section>
							    				<section class='col-3'>
							    					<section class='display'><p>Flight Hours</p><p>$totaltime</p><p>Total Flights $resultcheckvuel</p></section>
							    				</section>
							    				<section class='col-3'>
							    					<section class='display'><p>Release Count</p><p>$count</p></section>
							    				</section>
							    				<section class='col-3'>
							    					<section class='display'><p>Release After</p><p>$releaseafter</p></section>
							    				</section>
							    			</section>";
									    	
							    		
							    		
							    		
							    			$sqlsentdamage="SELECT * FROM damages WHERE flight_id='$lastflight'";
                                		
                                			$resultdamage=mysqli_query($conn, $sqlsentdamage);
				    			            
				    			           
				    			            $resultcheckdamage = mysqli_num_rows($resultdamage);
				    			            
				    			            if ($resultcheckdamage > 0)
				                            {
				                                while ($row6 = mysqli_fetch_assoc($resultdamage))
				                                {
				                                  $damagetype=$row6['damage_type_id'];  
				                                  $damagedesc=$row6['damage_description'];  
				                                 
				                                }
				                                
				                            if ($damagetype==1)
						                	{
						                		$damimg="../img/xroja.png";
						                	}
						                	elseif ($damagetype==2)
						                	{
						                		$damimg="../img/xrojacirculo.png";
						                	}
						                	elseif ($damagetype==3)
						                	{
						                		$damimg="../img/guion.png";
						                	}
						                	elseif ($damagetype==4)
						                	{
						                		$damimg="../img/diagonal.png";
						                	}    
				                                
				                                
				                                
				                                echo "<section class='row pad '>
				                                
				                                		<section class='col-12 display'>
							    							<section class='col-2'><img src='$damimg' id='imgdam2'></section><section class='col-10 ddes'><p class='ddes'>$damagedesc</p></section>
							    						</section>
							    						
							    					 </section>";
				                               
				                            }
				    			            
						    			        echo "</section>
													 </section>";
						    			           
									    		
									    		
                                }
                            }
                                

				
					 
					  
					  
				?>
			
			</div>
		</div>
	</div>
	<script src="photo.js" ></script>
</body>