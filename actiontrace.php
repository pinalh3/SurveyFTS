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
<!--	<link rel="script" type="javascript" href="visibility.js"> -->
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
					<p>TRACE ACTION</p>
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
			    <form action="" method="post">
			         <p>Search by</p>
                    <input type="checkbox" name="report"  class="checkbx" id="b1"> Report
                    <input type="checkbox" name="action"  class="checkbx" id="b2"> Action
                    <input type="checkbox" name="response"  class="checkbx" id="b3"> Responsible
                    <input type="checkbox" name="actiont"  class="checkbx" id="b4"> Action Type
                    <input type="checkbox" name="adate"  class="checkbx" id="b5"> Report Date
                    <input type="checkbox" name="deadline" class="checkbx" id="b6"> Deadline
                </form> 
			    </form>
				<form class="incform" action="" method="post">
					<div class="err"><span ><?php echo $errorp; ?></span><br></div>
				    <section class='row'>
				    	<section id='ac1' class=" col-3 hidden">
						    <label class="label1 ">Select Report ID</label>&nbsp;
						    
			                <?php    	
			                $sqlsent="SELECT * FROM vreport;";
		                    $result1=mysqli_query($conn, $sqlsent);
					        $result1check = mysqli_num_rows($result1);
		                    
		                    	if ($result1check > 0)
			                			    {
			                			    	echo "<datalist id='report'>";
			                			    	while ($row = mysqli_fetch_assoc($result1))
			                			        {
			                			        
			                			           echo "<option class='tabd' value=".$row['vreport_id'].">".$row['vreport_id']."</option>"; 
			                			        } 
			                			        echo "</datalist>";
			                			    }
		                    
					    		?>
					    	<input list="report" class="input1" type="text" name="selectrid">	
					    	
					    </section>
			    	
			    	
				    	<section id='ac2' class='hidden col-3'>
				    	<label class="label1 ">Action ID</label>&nbsp;
					    
		                <?php    	
		                $sqlsent2="SELECT * FROM action;";
	                    $result2=mysqli_query($conn, $sqlsent2);
				        $result2check = mysqli_num_rows($result2);
	                    
	                    	if ($result2check > 0)
		                			    {
		                			    	echo "<datalist id='action'>";
		                			    	while ($row = mysqli_fetch_assoc($result2))
		                			        {
		                			        
		                			           echo "<option class='tabd' value=".$row['action_id'].">".$row['action_id']."</option>"; 
		                			        } 
		                			        echo "</datalist>";
		                			    }
	                    
				    		?>
				    	<input list="action" class="input1" type="text" name="actionid">
				    	
				    	</section>
				    	
				    	
				    	<section id='ac3'class='hidden col-3'>
				    	<label class="label1  ">Responsible</label>&nbsp;
					    <select value="" name="responsible" class="input1 ">
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
				    	</section>
			    	
			    	
				    	<section id='ac4' class='hidden col-3'>
				    	<label class="label1  ">Action Type</label>&nbsp;
					    <select value="" name="actiontype" class="input1  ">
		                    	<option value="0" class="tabd" ></option>
		                <?php    	
		                $sqlsent2="SELECT * FROM action_type;";
	                    $result2=mysqli_query($conn, $sqlsent2);
				        $result2check = mysqli_num_rows($result2);
	                    
	                    	if ($result2check > 0)
		                			    {
		                			    	while ($row = mysqli_fetch_assoc($result2))
		                			        {
		                			        
		                			           echo "<option class='tabd' value=".$row['action_type_id'].">".$row['name']."</option>"; 
		                			        } 
		                			    }
	                    
				    		?>
				    	</select>
				    	</section>
			    	</section>
			    	</section>
			    	
			    	<section class="row">
			    		
					   	<section id="ac5" class="hidden col-6">
						   	<p>Report Date</p>
					   		<label class="label1 " id="">From</label>&nbsp;
					    	<input type="date" value="" name="reportdate" class="input1 " >
			                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   	
			                <label class="label1  ">To</label>&nbsp;
						    <input type="date" value="" name="reportdateto" class="input1  " >
			            </section>     
	                	
		                <section id='ac6' class='hidden col-6'>
			                <p>Deadline</p>
			                <label class="label1 ">From</label>&nbsp;
						    <input type="date" value="" name="deadlinedate" class="input1  " >
			                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   	
			                <label class="label1  a6">To</label>&nbsp;
						    <input type="date" value="" name="deadlinedateto" class="input1  " >
		                </section>  
	                </section> 
	                <br>
	                    	
	               <input type="Submit" value="Search" name="search" class="include">
	               
	                </form>
	               
	                 <?php
	                 
$registers=10;   
$lowlimit=0;

$page=1;    


 
	
if (isset($_POST['search'])) 
{
        $errorp = ""; // Variable To Store Error Message 

        
            $report_id= $_POST['selectrid'];
            $action_id= $_POST['actionid'];
            $responsible= $_POST['responsible'];
            $action_type= $_POST['actiontype'];
            $report_date=$_POST['reportdate'];
            $report_dateto=$_POST['reportdateto'];
            $deadline_date=$_POST['deadlinedate'];
            $deadline_dateto=$_POST['deadlinedateto'];
            
        	$querya="SELECT * FROM action AS c INNER JOIN action_status AS e INNER JOIN action_type AS g INNER JOIN vreport AS h INNER JOIN (SELECT a.action_id AS acta, a.limit_date AS deadline,a.crew_id AS resp, b.first_name, b.first_surname FROM action_responsible AS a JOIN crew AS b WHERE a.crew_id=b.crew_id) AS d WHERE c.action_id=d.acta AND e.action_status_id=c.action_status_id AND g.action_type_id=c.action_type_id AND c.vreport_id=h.vreport_id";
           
            $queryb="ORDER BY action_date";
            
            
        if ($report_dateto=="" && $report_date=="" && $deadline_dateto=="" && $deadline_date=="" && $report_id=="" && $action_id=="" && $responsible=="")
        {
        $sqlsent4="$querya $queryb";
        
        }
        else
        {
            
            if ($report_id!="")
            {
            	$queryc="AND c.vreport_id='".$report_id."'";
            	
            	$sqlsent4="$querya $queryc $queryb";
            	
            	
            }
            elseif ($action_id!="")
            {
            	$queryc="AND action_id='$action_id'";
            	
            	$sqlsent4="$querya $queryc $queryb";
            	
            }
            else
            {
            	if($report_dateto!="" || $report_date!="")
            	{
            		if($report_date=="" || $report_dateto=="")
            			{
            			$errorp= "Select report From and To dates";
            			
            			$control="1";
            			}
            			else
            			{
            			$queryd="AND report_date BETWEEN '".$report_date."' AND '".$report_dateto."' ";
            			}
            	}
            	
            	if($deadline_dateto!="" || $deadline_date!="")
		        {
		           		if($deadline_date=="" || $deadline_dateto=="")
		        		{
		        		$errorp= "Select deadline From and To dates";
		        		$control="1";
		        		
		        		}
		        		else
		        		{
		        		$queryh="AND deadline BETWEEN '".$deadline_date."' AND '".$deadline_dateto."' ";
		        		}
		        } 
            
            	
		        
	            if($responsible!="0")
				{
				$queryi= "AND resp='".$responsible."' ";
				          				
				}
				            
				if($action_type!="0")
				{
				$queryj=  "AND g.action_type_id='".$action_type."' ";
				
				}
	            
	            $sqlsent4=" $querya $queryd $queryh $queryi $queryj $queryb ";
            }
            			
        }
        
        
           	if($control!=1)
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
					                			        echo "<tr class='tabheader'><th>Action ID</th><th>Report Id</th><th>Action Type</th><th>Date</th><th>Responsible</th><th>Deadline</th><th>Status</th></tr>";
							                while ($row = mysqli_fetch_assoc($result5))
							                {
							                
							                echo "<tr class='tabd'><td>".$row['action_id']."</td><td>".$row['vreport_id']."</td><td>".$row['name']."</td><td>".$row['action_date']."</td><td>".$row['first_name']." ".$row['first_surname']."</td><td>".$row['deadline']."</td><td>".$row['status_name']."</td><td><form action='formats/atrace.php' target='_blank' method='post'><input type='text'name='view1' value='".$row['vreport_id']."' class='hi'><input type='text'name='view3' value='".$row['action_id']."' class='hi'><input type='submit'name='view' value='view'></form></td><td><form action='actioneffect.php' method='post'><input type='submit'name='effect' value='Effectiveness'><input type='text'name='view2' value='".$row['action_id']."' class='hi'></form></td></tr>"; 
							                
							                
							                
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
					                			        echo "<tr class='tabheader'><th>Action ID</th><th>Report Id</th><th>Action Type</th><th>Date</th><th>Responsible</th><th>Deadline</th><th>Status</th></tr>";
							                while ($row = mysqli_fetch_assoc($result5))
							                {
							                
							                echo "<tr class='tabd'><td>".$row['action_id']."</td><td>".$row['vreport_id']."</td><td>".$row['name']."</td><td>".$row['action_date']."</td><td>".$row['first_name']." ".$row['first_surname']."</td><td>".$row['deadline']."</td><td>".$row['status_name']."</td><td><form action='formats/atrace.php' target='_blank' method='post'><input type='text'name='view1' value='".$row['vreport_id']."' class='hi'><input type='text'name='view3' value='".$row['action_id']."' class='hi'><input type='submit'name='view' value='view'></form></td><td><form action='actioneffect.php' method='post'><input type='submit'name='effect' value='Update'><input type='text'name='view2' value='".$row['action_id']."' class='hi'></form></td></tr>"; 
							                
							                
							                
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
	<script src="visibility.js" ></script>

	
	
	
</body>