<!DOCTYPE html>
 <?php
    include_once ('con.php');
    include('session.php'); 
    //include('crewfrontmod.php'); 
    
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
				<div class="topr">&nbsp;</div>
				<div class="topr">
					<p>INCIDENTS</p>
				</div>
				<div class="topr right">
					<a href="incidentsinclude.php" class="include">Report Incident</a>
					<a href="actioninclude.php" class="include">Add Actions</a>
					<a href="actiontrace.php" class="include">Trace Action</a>
				</div>
				
			</div>
			<div class="col-11 formcontainer" id="">
			    
			     <div class="err"><span ><?php echo $errorp; ?></span><br></div>
			    <!--crew information-->
				<form class="incform" action="" method="post">
					<div class="err"><span ><?php echo $errorp; ?></span><br></div>
				    <label class="label1">Select Report ID</label>&nbsp;
				    
	                <?php    	
	                $sqlsent="SELECT * FROM vreport;";
                    $result1=mysqli_query($conn, $sqlsent);
			        $result1check = mysqli_num_rows($result1);
                    
                    	if ($result1check > 0)
	                			    {
	                			    	echo "<datalist id='reportid'>";
	                			    	while ($row = mysqli_fetch_assoc($result1))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['vreport_id'].">".$row['vreport_id']."</option>"; 
	                			        } 
	                			        echo "</datalist>";
	                			    }
                    
			    		?>
			    		<input list="reportid" name="selectrid" class="input1">
			    	
			    	<br><br>
			    	<label class="label1">Select Type</label>&nbsp;
				    <select value="" name="selecttype" class="input1" id="rtype">
	                    	<option value="0" class="tabd" ></option>
	                <?php    	
	                $sqlsent2="SELECT * FROM report_type;";
                    $result2=mysqli_query($conn, $sqlsent2);
			        $result2check = mysqli_num_rows($result2);
                    
                    	if ($result2check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['report_type_id'].">".$row['name']."</option>"; 
	                			        } 
	                			    }
                    
			    		?>
			    	</select>
			    	<br><br>
			    	
			    	
			    	
			    	<label class="label1">Reported By</label>&nbsp;
				    <select value="" name="reportedby" class="input1" id="repby">
	                    	<option value="0" class="tabd" ></option>
	                <?php    	
	                $sqlsent2="SELECT * FROM crew;";
                    $result2=mysqli_query($conn, $sqlsent2);
			        $result2check = mysqli_num_rows($result2);
                    
                    	if ($result2check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
	                			        
	                			           echo "<option class='tabd' value=".$row['crew_id'].">".$row['first_name']." ".$row['first_surname']."</option>"; 
	                			        } 
	                			    }
                    
			    		?>
			    	</select>
			    	<br><br>
			    	
			    	<p class="label">Select Date of Flight</p>
			    	<br>
			    	<label class="label1">From</label>&nbsp;
				    <input type="date" value="" name="selectdate" class="input1" id="sdate">
	                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   	
	                <label class="label1">To</label>&nbsp;
				    <input type="date" value="" name="selectdateto" class="input1" id="sdate">
	                <br><br>     	
	                    	
	               <input type="Submit" value="Search" name="search">
	               
	                </form>
	               
	                 <?php
	                 
$registers=10;   
$lowlimit=0;

$page=1;    
	
if (isset($_POST['search'])) 
{
        $errorp = ""; // Variable To Store Error Message 

        
            $report_id= $_POST['selectrid'];
            $report_type= $_POST['selecttype'];
            $reported_by= $_POST['reportedby'];
            $date= $_POST['selectdate'];
            $dateto=$_POST['selectdateto'];
            
        	$query1="SELECT * FROM vreport JOIN report_type  AS a JOIN crew AS b WHERE vreport.report_type_id=a.report_type_id AND vreport.reporting_crew_id=b.crew_id";
           
            
            $option="";
            
        if ($dateto=="" && $date=="" && $report_id=="" && $reported_by=="0" && $report_type=="0")
        {
        $errorp= "Select an Option";
        }
        else
        {
            
            if ($report_id!="")
            {
            		$option="AND vreport.vreport_id='".$report_id."' ORDER BY report_date ";
            				
							
							
					$sqlsent4="".$query1."  ".$option." ";	
					
					
            } 	
            elseif ($dateto!="" || $date!="")
            {
            	if($date=="" || $dateto=="")
            			{
            				$errorp= "Select From and To dates";
            				
            			}
            			else
            			{
            				$optionf="AND vreport.report_date BETWEEN '".$date."' AND '".$dateto."' ORDER BY report_date ";
            				
            				if($reported_by!="0")
				            {
				            $optionb= "AND vreport.reporting_crew_id='".$reported_by."' ";
				            				
				            }
				            
				            if($report_type!="0")
				            {
				            $optiont=  "AND vreport.report_type_id='".$report_type."' ";
				            }
            				
            				$sqlsent4=" ".$query1."  ".$optionb." ".$optiont." ".$optionf." ";
            				
            				
            				
            				
            				
            			}
            			
            }	
            else
            {
	            if($reported_by!="0")
	            {
	            $optionb= "AND vreport.reporting_crew_id='".$reported_by."' ";
	            				
	            }
	            
	            if($report_type!="0")
	            {
	            $optiont=  "AND vreport.report_type_id='".$report_type."' ";
	            }
            			
						
            		
	            		$sqlsent4=" ".$query1."  ".$optionb." ".$optiont." ";	
	            		
	            		
	            				
            }
            	
           
            
            
            
            
        
           
           
        }
 
			 
	           
           
            	
	if (!empty($sqlsent4))	
    { 
            $result4=mysqli_query($conn, $sqlsent4);
			 $result4check = mysqli_num_rows($result4); 
            $totalresults=$result4check;
             $pag=1;
			 $pages=ceil($result4check/$registers);
			 
			 
			 //pagina siguiente y previa
				$prev=$page;
				$nxt=$page;
				if($page>1)
				{
					$prev=$page-1;
				}
				
				if($page<$pages)
				{
					$nxt=$page+1;
				}
				
			 
			  $limit="LIMIT $lowlimit, $registers";
			 
			 $sqlsentdef="".$sqlsent4." ".$limit."";
			 $result5=mysqli_query($conn, $sqlsentdef);
			 $result5check = mysqli_num_rows($result5); 
			 
				                if ($result5check > 0)
				                    {   
				                         echo "<p>Found ".$totalresults." results</p><br>";
				                        
				                         echo "<form name='let' action='' method='post'>";
							                echo "<section class='row'><button class='pagin' value='$prev' name='pag'>&laquo;</button>";
							               $links = array();
									         for( $i=1; $i<=$pages ; $i++)
									         {
									            $links[] = "<button class='pagin' value='$i' name='pag'>$i</button>"; 
									         }
									         echo implode(" ", $links);
							                echo "<button class='pagin' value='$nxt' name='pag'>&raquo;</button></section>";
							                echo "<section class='row'><p>pagina $page de $pages</p></section>";
							                echo "<input type='hidden' name='pages' value='$pages'>";
							                echo "</form>";
				                        
				                        
					                			        echo "<table class='query'>";
					                			        echo "<tr class='tabheader'><th>Report Id</th><th>Date</th><th>Report Type</th><th>Reported By</th></tr>";
							                while ($row = mysqli_fetch_assoc($result5))
							                {
							                
							                echo "<tr class='tabd'><td>".$row['vreport_id']."</td><td>".$row['report_date']."</td><td>".$row['name']."</td><td>".$row['first_name']." ".$row['first_surname']."</td><td><form action='formats/events.php' target='_blank' method='post'><input type='text'name='view1' value='".$row['vreport_id']."' class='hi'><input type='submit'name='view' value='view'></form></td></tr>"; 
							                
							                
							                
							                }
							                mysqli_close($conn);
							                echo "</table>";
							               
				                    }
									else
							       {
							                $errorp= "did not find matches";
				                    }
				        $_SESSION['query'] = $sqlsent4;  
				        $_SESSION['results'] = $totalresults; 
    }	

}
		 
			 if(isset($_POST["pag"]))
			 {
				$pag=(int) $_POST["pag"];
				$page=$pag;
				$query2=$_SESSION['query'];
				$pages=$_POST['pages'];
				$totalresults=$_SESSION['results'];
				
				$lowlimit=($pag-1)*$registers;
				$sqlsent4=$query2;
				
				//pagina siguiente y previa
				$prev=$page;
				$nxt=$page;
				if($page>1)
				{
					$prev=$page-1;
				}
				
				if($page<$pages)
				{
					$nxt=$page+1;
				}
				
				
			 
			 $limit="LIMIT $lowlimit, $registers";
			 
			 $sqlsentdef="".$sqlsent4." ".$limit."";
			 $result5=mysqli_query($conn, $sqlsentdef);
			 $result5check = mysqli_num_rows($result5); 
			 
				                if ($result5check > 0)
				                    {   
				                        echo "<p>Found ".$totalresults." results</p><br>";
				                        
				                         echo "<form name='let' action='' method='post'>";
							                echo "<section class='row'><button class='pagin' value='$prev' name='pag'>&laquo;</button>";
							               $links = array();
									         for( $i=1; $i<=$pages ; $i++)
									         {
									            $links[] = "<button class='pagin' value='$i' name='pag'>$i</button>"; 
									         }
									         echo implode(" ", $links);
							                echo "<button class='pagin' value='$nxt' name='pag'>&raquo;</button></section>";
							                echo "<section class='row'><p>pagina $page de $pages</p></section>";
							                echo "<input type='hidden' name='pages' value='$pages'>";
							                echo "</form>";
				                        
				                        
				                        
					                			        echo "<table class='query'>";
					                			        echo "<tr class='tabheader'><th>Report Id</th><th>Date</th><th>Report Type</th><th>Reported By</th></tr>";
							                while ($row = mysqli_fetch_assoc($result5))
							                {
							                
							                echo "<tr class='tabd'><td>".$row['vreport_id']."</td><td>".$row['report_date']."</td><td>".$row['name']."</td><td>".$row['first_name']." ".$row['first_surname']."</td><td><form action='formats/events.php' target='_blank' method='post'><input type='text'name='view1' value='".$row['vreport_id']."' class='hi'><input type='submit'name='view' value='view'></form></td></tr>"; 
							                
							                
							                
							                }
							                mysqli_close($conn);
							                echo "</table>";
							               
				                    }
									else
							       {
							                $errorp= "did not find matches";
				                    }
			 
			 
			 }
							  
            
            
            echo $errorp;
            
			
				

?>    	
	               
	               
	           
	               
	               
	               
	               
	               
	               
	               
			  
			    	
			    	
			    
			   
				
			
			</div>
		</div>
	</div>
	<script src="photo.js" ></script>
</body>