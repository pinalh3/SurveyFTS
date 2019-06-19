<!DOCTYPE html>
 <?php
    include_once 'con.php';
    include('session.php');
    include('crewinsert.php');
    
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
							<li><a href="">UAV</a></li>
							<li><a href="">Batteries</a></li>
							<li><a href="">Motors</a></li>
							<li><a href="">Servos</a></li>
							<li><a href="">Payloads</a></li>
							<li><a href="">Consumables</a></li>
							<li><a href="">Equipment</a></li>
							<li><a href="">Vehicles</a></li>
							<li><a href="">Locations</a></li>
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
				<div class="err"><span ><?php echo $errorp; echo "<br>"; ?></span></div>
				
			    <form class="incform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 
				    <div>
				    	
				        <input type="text" name="dni" value="" placeholder="Dni" class="input1" required maxlength="10">
				        <br><br>
				        <input type="text" name="firstname" value="" placeholder="First Name" class="input1" required maxlength="20">
	                    <input type="text" name="secondname" value="" placeholder="Second Name" class="input1" maxlength="20">
	                    <br><br>
	                    <input type="text" name="firstsurname" value="" placeholder="First Surname" class="input1" required maxlength="20">
	                    <input type="text" name="secondsurname" value="" placeholder="Second Surname" class="input1" maxlength="20">
	                    <br><br>
	                    <p>Birth Date</p>
	                    <input type="date" name="birthdate" value="" placeholder="Birthdate" class="input1" required>
	                    <br>
	                    <p>Estate</p>
	                    <select value="" name="selectstate" class="input1" required="required" id="sestate">
	                    	<option value="0" class="tabd" ></option>
	                          <?php
				                    $sqlsent="SELECT * FROM estate;";
				                    $result2=mysqli_query($conn, $sqlsent);
				                    $result2check = mysqli_num_rows($result2);
				    				
				    				if ($result2check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
	                			        
	                			           echo "<option class='tabd ".$row['name']."' value=".$row['estate_id'].">".$row['name']."</option>"; 
	                			        } 
	                			    }
	                			    ?>
			                			    
				    
	                          
	                    </select> 
	                    <br>
	                    <p>Municipality</p>
	                    <select name="municipality" value="" class="input1" required id="smunic">
	                          <option value="0" class="tabd" ></option>
	                          <?php
	                        		
	                        		$sqlsent1="SELECT * FROM municipality;";
				                    $result3=mysqli_query($conn, $sqlsent1);
				                    $result3check = mysqli_num_rows($result3);
				    				
				    				if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
	                			        
	                			           echo "<option class='hi tabd e".$row['estate_id']."'value=".$row['municipality_id'].">".$row['name']."</option>"; 
	                			        } 
	                			    }
	                			    //mysqli_close($conn);
	                		?>
				    
				    	
	                          
	                    </select>
	                    <br>
	                    <p>City</p>
	                    <select name="city" value="" class="input1" required id="scity">
	                          <option value="0" class="tabd" ></option>
	                          <?php
	                        		
	                        		$sqlsent2="SELECT * FROM city;";
				                    $result4=mysqli_query($conn, $sqlsent2);
				                    $result4check = mysqli_num_rows($result4);
				    				
				    				if ($result4check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result4))
	                			        {
	                			        
	                			           echo "<option class='hi tabd m".$row['municipality_id']."'value=".$row['city_id'].">".$row['name']."</option>"; 
	                			        } 
	                			    }
	                			    //mysqli_close($conn);
	                		?>
				    
				    	
	                          
	                    </select>
	                    <br><br>
	                    <input type="text" name="address" value="" placeholder="Address" class="input1" required size="100" maxlength="100">
	                    <br><br>
	                    <input type="text" name="emergencyc" value="" placeholder="Emergency contact" class="input1" maxlength="30">
	                    <br><br>
	                   
	                    <input type="submit" class="include" name="submit" value="Submit">
	                    

			    </form>	
			    		
			    
			    	
			    	
			    	
				</div>
				
			
			</div>
		</div>
	</div>
	<script src="photo.js" ></script>
	<script type="text/javascript">
		
		document.getElementById("sestate").addEventListener("change", select12);
		
		
		function select12()
		{
		//reset municipality select to 0 every time estate is changed
		document.getElementById("smunic").selectedIndex=0;
		document.getElementById("scity").selectedIndex=0;
		//hide when selection has not been made
		var n=document.getElementById("smunic");
		var d=n.getElementsByTagName("option");
		let y;
			for (y = 0; y < d.length; y++)
				{
				d[y].style.display = 'none';
				console.log(d[y]);
				}
		
		let i=document.getElementById("scity");
		let j=i.getElementsByTagName("option");
		let k;
			for (k = 0; k < j.length; k++)
				{
				j[k].style.display = 'none';
				console.log(j[k]);
				}		
		
				
				
				
				
		//display when selection has been made on estate
		var e=document.getElementById("sestate").value;
		//console.log(e);
		let c="e"+e;
		//console.log(c);
		
		
		let a=document.getElementsByClassName(c);
		let x;
		
			for (x = 0; x < a.length; x++)
				{
				a[x].style.display = 'block';
				//console.log(a[x]);
				}
		}		
				
		//Select municipality
		document.getElementById("smunic").addEventListener("change", select2);
		
		
		function select2()
		{
		//reset city select to 0 every time estate is changed
		document.getElementById("scity").selectedIndex=0;
		//hide when selection has not been made
		let p=document.getElementById("scity");
		let z=p.getElementsByTagName("option");
		let q;
			for (q = 0; q < z.length; q++)
				{
				z[q].style.display = 'none';
				//console.log(z[q]);
				}
				
		//display when selection has been made on estate
		var h=document.getElementById("smunic").value;
		//console.log(h);
		let c="m"+h;
		//console.log(c);
		
		
		let a=document.getElementsByClassName(c);
		let x;
		
			for (x = 0; x < a.length; x++)
				{
				a[x].style.display = 'block';
				//console.log(a[x]);
				}
				
		
		}
		
		
	
	</script>
</body>