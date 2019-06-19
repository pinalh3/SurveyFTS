<?php

include_once '../con.php';

?>



<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/css/flightlog.css">
	<link rel="stylesheet" type="text/css" href="/css/stylesuav2.css">
</head>
<body>
	 <?php
			    	
			    	//$special = 'htmlspecialchars($_SERVER["PHP_SELF"]);';
	                //$errorp = ''; // Variable To Store Error Message 
                    if (isset($_POST['view'])) 
                    { 
                    $flight= $_POST["view1"];
                    
			    
                    $sqlsentl="SELECT * FROM flightslog
							INNER JOIN (
							(SELECT operator.flights_id, crew.first_name AS opname, crew.first_surname AS oplastname 
							FROM operator
							INNER JOIN crew
							WHERE op_crew_id=crew_id
							) AS op
							
							INNER JOIN (
							SELECT technic.flights_id, crew.first_name AS tcname, crew.first_surname AS tclastname
							FROM technic
							INNER JOIN crew
							WHERE tc_crew_id=crew_id
							) AS tc
							)
							
							JOIN 
							uav
							
							JOIN
							operation_area
							
							WHERE flightslog.flights_id=op.flights_id 
							AND flightslog.flights_id=tc.flights_id 
							AND flightslog.uav_id=uav.uav_id 
							AND flightslog.operation_area_id = operation_area.operation_area_id
							AND flightslog.flights_id='".$flight."';";
							
                    
                    $resultl=mysqli_query($conn, $sqlsentl);
			        $resultlcheck = mysqli_num_rows($resultl);
                    echo $result1check;
                    	if ($resultlcheck > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($resultl))
	                			        {
			    						$date=$row['fdate'];
			    						$operator="".$row['opname']." ".$row['oplastname']."";
			    						$technic="".$row['tcname']." ".$row['tclastname']."";
			    						$uav=$row['uav_serial'];
			    						$starttime=$row['start_time'];
			    						$endtime=$row['end_time'];
			    						$windspeed=$row['windspeed'];
			    						$timeflight=$row['time_flight'];
			    						$maxheight=$row['maxheight'];
			    						$comments=$row['comments'];
			    						$temperature=$row['flight_temperature'];
			    						
			    						//ids for querys
			    						$uavid=$row['uav_id'];
			    						$antennaid=$row['antenna_id'];
			    						$payloadid=$row['payload_id'];
			    						$batteriesid=$row['batteries_id'];
			    						$wconditionsid=$row['wconditions_id'];
			    						$opeobjid=$row['opeobj_id'];
			    						
			    						
			    						
			    						
			    						
			    						
	                			        }
	                			    	
	                			    }
	                			        
	                 $sqlsent2="SELECT * FROM flightslog
							INNER JOIN (
							(SELECT parachuter.flight_id, crew.first_name AS ppname, crew.first_surname AS pplastname 
							FROM parachuter
							INNER JOIN crew
							WHERE p_crew_id=crew_id
							) AS pp
							
							INNER JOIN (
							SELECT uav_responsible.flight_id, crew.first_name AS uavrname, crew.first_surname AS uavrlastname
							FROM uav_responsible
							INNER JOIN crew
							WHERE uav_crew_id=crew_id
							) AS uavr
							)
							
							JOIN 
							uav
							
							
							WHERE flightslog.flights_id=pp.flight_id 
							AND flightslog.flights_id=uavr.flight_id 
							AND flightslog.uav_id=uav.uav_id 
							AND flightslog.flights_id='".$flight."';";
							
                    
                    $result2=mysqli_query($conn, $sqlsent2);
			        $result2check = mysqli_num_rows($result2);
                    
                    	if ($result2check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
			    						
			    						$pp="".$row['ppname']." ".$row['pplastname']."";
			    						$uavr="".$row['uavrname']." ".$row['uavrlastname']."";
			    						
			    						
			    						
	                			        }
	                			    	
	                			    }
	                			      
	                		
							
	                			      
	                $sqlsent3="SELECT * FROM uav 			
							JOIN uav_model
							WHERE uav.uav_model_id=uav_model.uav_model_id 
							AND uav.uav_id='".$uavid."';";
							
					
                    
                    $result3=mysqli_query($conn, $sqlsent3);
			        $result3check = mysqli_num_rows($result3);
                    
                    	if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
			    						
			    						$uavmodel=$row['name'];
			    						
			    						
	                			        }
	                			    	
	                			    }			      
	                			      
	                
	                
	                $sqlsent4="SELECT * FROM antenna 			
							
							WHERE antenna_id='".$antennaid."';";
							
					
                    
                    $result4=mysqli_query($conn, $sqlsent4);
			        $result4check = mysqli_num_rows($result4);
                    
                    	if ($result4check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result4))
	                			        {
			    						
			    						$antenna=$row['antenna'];
			    						
			    						
	                			        }
	                			    	
	                			    }					      
	                			      
	                
	                $sqlsent5="SELECT * FROM batteries 			
							
							WHERE batteries_id='".$batteriesid."';";
							
					
                    
                    $result5=mysqli_query($conn, $sqlsent5);
			        $result5check = mysqli_num_rows($result5);
                    
                    	if ($result5check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result5))
	                			        {
			    						
			    						$battery=$row['batt_serial'];
			    						
			    						
	                			        }
	                			    	
	                			    }			      
	                			      
	                			   
	                			   
	                $sqlsent6="SELECT * FROM weather 			
							
							WHERE wconditions_id='".$wconditionsid."';";
							
					
                    
                    $result6=mysqli_query($conn, $sqlsent6);
			        $result6check = mysqli_num_rows($result6);
                    
                    	if ($result6check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result6))
	                			        {
			    						
			    						$weather=$row['weather_name'];
			    						
			    						
	                			        }
	                			    	
	                			    }	
	                			    
	                			    
	               $sqlsent7="SELECT * FROM objective 			
							
							WHERE opeobj_id='".$opeobjid."';";
							
					
                    
                    $result7=mysqli_query($conn, $sqlsent7);
			        $result7check = mysqli_num_rows($result7);
                    
                    	if ($result7check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result7))
	                			        {
			    						
			    						$opeobj=$row['ope_name'];
			    						
			    						
	                			        }
	                			    	
	                			    }
	                			    
	                			    
	                			    
	                  $sqlsent8="SELECT * FROM payloads 			
							JOIN paytype
							WHERE paytype.paytype_id=payloads.paytype_id 
							AND payload_id='".$payloadid."';";
							
					
                    
                    $result8=mysqli_query($conn, $sqlsent8);
			        $result8check = mysqli_num_rows($result8);
                    
                    	if ($result8check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result8))
	                			        {
			    						
			    						$payload=$row['pay_serial'];
			    						$paytype=$row['payname'];
			    						
	                			        }
	                			    	
	                			    }			      
	                
	                $sqlsent9="SELECT * FROM damages 			
							JOIN damage_type
							WHERE damages.damage_type_id=damage_type.damage_type_id 
							AND flight_id='$flight';";
							
					
                    
                    $result9=mysqli_query($conn, $sqlsent9);
			        $result9check = mysqli_num_rows($result9);
                    
                    	if ($result9check == 0)
	                			    {
	                			    $damagedescription="";
			    					$damagetype="";
	                			    }
	                			    else
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result9))
	                			        {
			    						
			    					
			    						$damagedescription=$row['damage_description'];
			    						$damagetype=$row['damage_type_id'];
			    						
	                			        }
	                			    	
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
	                //require another query
			    						
			    						
			    	$sqlsenttotime="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(time_flight))) AS hours FROM flightslog WHERE uav_id=$uavid";
                                		
                    $resulttime=mysqli_query($conn, $sqlsenttotime);
				    			            
				    $resultcheckttime = mysqli_num_rows($resulttime); 
				    			            
				    if ($resultcheckttime > 0)
				    {
				    	while ($row5 = mysqli_fetch_assoc($resulttime))
					    {
					     $totaltime=$row5['hours'];  
					                          
					    }
				                               
				    }				
	                			      
                    }
			     ?>
	
	
	
	
	
	
	
	
	
	<!-- Formato de Registro de Vuelo -->
	<div id="s">
	<section class="row">
		<section class="col-4"><img src="/img/gpb.jpg" style="width:297px;height:102px;"></section>
		<section class="col-4" ><br><br><p style="font-size:22px; font-weight:bold; vertical-align:middle;">REGISTRO DE VUELO</p></section>
		<section class="col-4"></section>
	</section>
	
	<section class="row">
		<section class="col-2"></section>
		<section class="col-4"><p class="title">Hoja de Registro Nº:</p>&nbsp;&nbsp;&nbsp;<p class="tbord"><?php echo $flight; ?></p></section>
		<section class="col-4"><p class="title">Fecha:</p>&nbsp;&nbsp;&nbsp;<p class="tbord"><?php echo $date; ?></p></section>
		<section class="col-2"></section>
		
	
	</section>
	<br>
	
	<section class="row hd1"><p class="ph">DATOS DE LA TRIPULACION</p></section>
	
	<section class="lat">
	<br><br>
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"><p class="title">Operador: </p><p class="tbord"><?php echo $operator; ?></p></section>
		<section class="col-4"><p class="title">___________________________________________</p></section>
		<section class="col-2"></section>
		
	
	</section>
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"></section>
		<section class="col-4 center small">Firma</section>
		<section class="col-2"></section>
		
	
	</section>
		<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"><p class="title">Tecnico: </p><p class="tbord"><?php echo $technic; ?></p></section>
		<section class="col-4"><p class="title">___________________________________________</p></section>
		<section class="col-2"></section>
		
	
	</section>
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"></section>
		<section class="col-4 center small">Firma</section>
		<section class="col-2"></section>
		
	
	</section>
	<br>
	</section>
	
	
	<section class="row hd1"><p class="ph">DATOS DEL EQUIPO UTILIZADO</p></section>
	
	<section class="lat">
	<br>
	<section class="row ">
		<section class="col-1"></section>
		<section class="col-3"><p class="title">Tipo Antena: </p><p class="tbord"><?php echo $antenna; ?></p></section>
		<section class="col-3"><p class="title">Nº de Payload: </p><p class="tbord"><?php echo $payload; ?></p></section>
		<section class="col-4"><p class="title">Tipo de Payload: </p><p class="tbord"><?php echo $paytype; ?></p></section>
		<section class="col-1"></section>
		
		
	
	</section>
	<br>
	<section class="row ">
		<section class="col-1"></section>
		<section class="col-3"><p class="title">Modelo de RPA: </p><p class="tbord"><?php echo $uavmodel; ?></p></section>
		<section class="col-3"><p class="title">Nº de RPA: </p><p class="tbord"><?php echo $uav; ?></p></section>
		<section class="col-4"><p class="title">Nº de Bateria: </p><p class="tbord"><?php echo $battery; ?></p></section>
		<section class="col-1"></section>
		
		
	
	</section>
	
	<br>
	<section class="row ">
		<section class="col-1"></section>
		<section class="col-4"><p class="title">Release Cambiado antes del Vuelo: </p><p class="tbord">No</p></section>
		<section class="col-8"></section>
		
		
	
	</section>
	
	<br>
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"><p class="title">Preparador Paracaidas: </p><p class="tbord"><?php echo $pp; ?></p></section>
		<section class="col-4"><p class="title">___________________________________________</p></section>
		<section class="col-2"></section>
		
	
	</section>
	
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"></section>
		<section class="col-4 center small">Nombre, Apellido, Firma</section>
		<section class="col-2"></section>
		
	
	</section>
	
	<br>
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"><p class="title">Preparador RPA: </p><p class="tbord"><?php echo $uavr; ?></p></section>
		<section class="col-4"><p class="title">___________________________________________</p></section>
		<section class="col-2"></section>
		
	
	</section>
	
	<section class="row ">
		<section class="col-2"></section>
		<section class="col-4"></section>
		<section class="col-4 center small">Nombre, Apellido, Firma</section>
		<section class="col-2"></section>
	
	</section>
	
	<br>
	</section>
	
	<section class="row hd1"><p class="ph">CONDICIONES DEL VUELO</p></section>
	
	
	
	<section class="lat">
	<br><br>
	<section class="row ">
		<section class="col-1"></section>
		<section class="col-2"><p class="title">Tiempo: </p><p class="tbord"><?php echo $weather; ?></p></section>
		<section class="col-2"><p class="title">Temperatura: </p><p class="tbord"><?php echo $temperature; ?>ºC</p></section>
		<section class="col-3"><p class="title">Objetivo del Vuelo: </p><p class="tbord"><?php echo $opeobj; ?></p></section>
		<section class="col-3"><p class="title">Horas de vuelo total: </p><p class="tbord"><?php echo $totaltime; ?></p></section>
		<section class="col-1"></section>
		
	
	</section>
	<br>
	<section class="row ">
		<section class="col-1"></section>
		<section class="col-2"><p class="title">V.Viento (m/s): </p><p class="tbord"><?php echo $windspeed; ?></p></section>
		<section class="col-3"><p class="title">Hora Inicio Vuelo: </p><p class="tbord"><?php echo $starttime; ?></p></section>
		<section class="col-3"><p class="title">Tiempo de Vuelo: </p><p class="tbord"><?php echo $timeflight; ?></p></section>
		<section class="col-2"><p class="title">Horas ultimo mant: </p><p class="tbord"><?php echo $timemant; ?></p></section>
		<section class="col-1"></section>
		
	
	</section>
	<br>
	<section class="row ">
		<section class="col-1"></section>
		<section class="col-3"><p class="title">Altura Maxima: </p><p class="tbord"><?php echo $maxheight; ?></p></section>
		<section class="col-3"><p class="title">Hora Culminacion Vuelo: </p><p class="tbord"><?php echo $endtime; ?></p></section>
		<section class="col-4"><p class="title">Release Activado: </p><p class="tbord">No</p></section>
		<section class="col-1"></section>
		
	
	</section>
	<br>
	<section class="row top">
		<section class="col-2">Observaciones:</section>
		<section class="col-10"><p class="tbord"><?php echo $comments; ?>Las laderas del campo florecen mientras la primavera se adentra y las abejas polinizan las flores que adornan el paisaje, el invierno termina y la vida abunda en el jardin de la casa</p></section>
		
	
	</section>
		
	<br>
	</section>
	<section class="row hd1"><p class="ph">REGISTRO DE FALLOS EN RPA DESPUES DE ATERRIZAJE</p></section>
	
	
	
	
	<section class="row hd1">
		<section class="col-2 right"><p class="ph">Simbolo</p></section>
		<section class="col-10"><p class="ph">Descripcion</p></section>
	
	</section>
	
	<section class="lat bottom">
	
	<section class="row">
		<section class="col-2 right"><input type="hidden" value="<?php echo $damagetype; ?>" id="dt"><img src="<?php echo $damimg ?>" id="simb"></section>
		<section class="col-10"><p class="tbord"><?php echo $damagedescription; ?></p></section>
	
	</section>
	
	</section>
	
	<section class="row"><p class="ph red">En caso de haber efectuado una reparacion</p></section>
	
	<section class="lat">
	
	<section class="row borders">
		<section class="col-2 right hd2"><p class="ph">Iniciales</p></section>
		<section class="col-2"></section>
		<section class="col-2 right hd2 left"><p class="ph">Firma del Ejecutor</p></section>
		<section class="col-6"></section>
	</section>
	
	</section>
	
	</div>
		
		
		
	
</body>
