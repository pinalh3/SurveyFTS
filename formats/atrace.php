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
			    	
			    	
                    if (isset($_POST['view'])) 
                    { 
                    $report= $_POST["view1"];
                    
			    
                    $sqlsentl="SELECT * FROM vreport AS v
								INNER JOIN (SELECT report_type.report_type_id, report_type.name AS rtype FROM report_type) AS a
								INNER JOIN detection AS b
								INNER JOIN crew AS c
								WHERE v.report_type_id=a.report_type_id 
								AND v.detection_id=b.detection_id
								AND v.reporting_crew_id=c.crew_id
								AND v.vreport_id='$report'";
							
                    
                    $resultl=mysqli_query($conn, $sqlsentl);
			        $resultlcheck = mysqli_num_rows($resultl);
                    
                    	if ($resultlcheck > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($resultl))
	                			        {
			    						$vreport_id=$row['vreport_id'];
			    						$date=$row['report_date'];
			    						$report_type_id=$row['report_type_id'];
			    						$report_type=$row['rtype'];
			    						$detection_id=$row['detection_id'];
			    						$detection=['name'];
			    						$description=$row['report_description'];
			    						$analisys=$row['cause_analisys'];
			    						$reportedby=$row['first_name']." ".$row['first_surname'];
			    						
			    						
			    						
			    						
	                			        }
	                			    	
	                			    }
	              
	                $action= $_POST["view3"];  			        
	                
	                $sqlsent2=" SELECT * FROM action AS v
								INNER JOIN (SELECT action_type.action_type_id, action_type.name AS atype FROM action_type) AS a
								INNER JOIN action_responsible AS b
								INNER JOIN crew AS c
								INNER JOIN action_status AS d
								WHERE v.action_type_id=a.action_type_id 
								AND b.crew_id=c.crew_id
								AND v.action_id=b.action_id
								AND v.action_status_id=d.action_status_id
								AND v.action_id='$action'";
							
	                $result2=mysqli_query($conn, $sqlsent2);
			        $result2check = mysqli_num_rows($result2);
                    
                    	if ($result2check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
			    						$action_id=$row['action_id'];
			    						$adate=$row['action_date'];
			    						$action_description=$row['action_description'];
			    						$action_type=$row['atype'];
			    						$deadline=$row['limit_date'];
			    						$responsible=$row['first_name']." ".$row['first_surname'];
			    						$dni=$row['dni'];
			    						$status=$row['status_name'];
			    						
			    						
			    						
			    						
			    						
	                			        }
	                			    	
	                			    }			      
	               
	               
	               
	               $sqlsent3=" SELECT * FROM action_effectiveness AS v
								WHERE v.action_id='$action'";
							
	                $result3=mysqli_query($conn, $sqlsent3);
			        $result3check = mysqli_num_rows($result3);
                    
                    	if ($result3check > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($result2))
	                			        {
			    						
			    						$deadline=$row['limit_date'];
			    						
			    						
			    						
			    						
			    						
			    						
	                			        }
	                			    	
	                			    }			 
	               
	               
	                			      
                    }
			     ?>
	
	
	
	
	
	
	
	
	
	<!-- Formato de Seguimiento de las Acciones -->
	<div id="s">
	<section class="row">
		<section class="col-4"><img src="/img/gpb.jpg" style="width:297px;height:102px;"></section>
		<section class="col-8"></section>
	</section>
	
	<section class="row">
		
		<section class="col-12 align" ><p style="font-size:22px; font-weight:bold; vertical-align:middle;" class="margin">PLANILLA DE SEGUIMIENTO DE REPORTES DE EVENTOS Y PELIGROS</p><br><br></section>
		
	</section>
	
	<section class="row ">
		<section class="col-12 pneg hd1 ">Datos del Reporte:</section>
		
	</section>
	
	
	<section class="row">
	    <section class="col-1 pneg borders align"><p class="">Nº de Reporte:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $vreport_id; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Fecha del Reporte:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $date; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Evento:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $report_type; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Forma de Deteccion:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $detection; ?></p></section>
	    
	</section>    
	
	
	<section class="row ">
		<section class="col-6 pneg hd1">Reportado por:</section>
		<section class="col-6 pneg borders align"><?php echo $reportedby; ?></section>
		
	
	</section>

	<!-- Descripcion de evento -->
	<section class="row ">
		<section class="col-12 hd1">Descripción del Evento o Peligro, Vulnerabilidad, Oportunidad de Mejora, No Conformidad</section>
		
	</section>
	
	<section class="row borders">
	    <p class="tbord"><?php echo $description; ?></p>
	</section>
	
	</section>
	
	<!-- Analisis de la Causa -->
	<section class="row ">
		<section class="col-12 hd1">Análisis de la Causa</section>
		
	</section>
	
	<section class="row borders">
	    <p class="tbord"><?php echo $analisys; ?></p>
	</section>
	
	
	<!-- Datos de la Accion -->
	<br>
	<section class="row ">
		<section class="col-12 hd1">Datos de la Acción:</section>
		
	</section>
	
	<section class="row">
	    <section class="col-1 pneg borders align"><p class="">Nº de Acción:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $action_id; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Fecha de la acción:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $adate; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Tipo de acción:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $action_type; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Estatus:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $status; ?></p></section>
	    
	</section>    
	
	
	<section class="row ">
		<section class="col-4 pneg hd1">Responsable:</section>
		<section class="col-4 pneg borders align"><?php echo "".$responsible." C.I.".$dni.""; ?></section>
		<section class="col-2 pneg hd1">Fecha Limite:</section>
		<section class="col-2 pneg borders align"><?php echo $deadline; ?></section>
	
	</section>
	
	<br>
	
	<!-- Acciones -->
	
	<?php
	
	if(isset($_POST['view']))
	{
	$action= $_POST["view3"]; 
	$sqlsent3=" SELECT * FROM action_effectiveness AS v
								WHERE v.action_id='$action'";
							
	                $result3=mysqli_query($conn, $sqlsent3);
			        $result3check = mysqli_num_rows($result3);
                    
                    	if ($result3check > 0)
	                			    {
	                			            echo "<section class='row '>
		                                                <section class='col-12 hd1'>Seguimiento a las acciones</section>
		
	                                              </section>";
	                			            
	                			    	while ($row = mysqli_fetch_assoc($result3))
	                			        {
			    						
			    						echo "
			    						<section class='row'>
			    						    <section class='col-2 pneg hd1'>Numero de seguimiento:</section>
			    						    <section class='col-3 pneg borders align'>".$row['action_effect_id']."</section>
			    						    <section class='col-2 pneg hd1'>Fecha de registro:</section>
			    						    <section class='col-3 pneg borders align'>".$row['verification_date']."</section>
			    						    <section class='col-1 pneg hd1'>Status Changed:</section>
			    						    <section class='col-1 pneg borders align'>".$row['status_changed']."</section>
			    						</section>
			    						<section class='row'>
			    						    <section class='col-2 pneg hd1'>Observaciones</section>
			    						    <section class='col-10 tbord pneg borders'>".$row['observations']."</section>
			    						</section>
			    						<br>
			    						";
			    						
			    						
			    						
			    						
	                			        }
	                			        
	                			        
	                			    	
	                			    }			 
	               
	               
	}
	?>
	
	
	
	<section class="row ">
		<section class="col-2 hd1 pneg borders align"><p>fecha: </p></section>
		<section class="col-4 pneg borders align margin"></section>
		<section class="col-2 hd1 pneg borders align"><p>Firma: </p></section>
		<section class="col-4 pneg borders align margin"></section>
	</section>	
	
	
		
	</div>
	
</body>
