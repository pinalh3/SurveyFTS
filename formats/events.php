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
                    echo $result1check;
                    	if ($resultlcheck > 0)
	                			    {
	                			    	while ($row = mysqli_fetch_assoc($resultl))
	                			        {
			    						$vreport_id=$row['vreport_id'];
			    						$date=$row['report_date'];
			    						$report_type_id=$row['report_type_id'];
			    						$detection_id=$row['detection_id'];
			    						$description=$row['report_description'];
			    						$analisys=$row['cause_analisys'];
			    						$reportedby=$row['first_name']." ".$row['first_surname'];
			    						$reportt="tr$report_type_id";
			    						$detect="fd$detection_id";
			    					
			    						echo $detect;
			    						
	                			        }
	                			    	
	                			    }
	                			        
	                 
	                			      
	                		
							
	                			      
	               
	                			      
                    }
			     ?>
	
	
	
	
	
	
	
	
	
	<!-- Formato de Registro de Vuelo -->
	<div id="s">
	<section class="row">
		<section class="col-4"><img src="/img/gpb.jpg" style="width:297px;height:102px;"></section>
		<section class="col-8"></section>
	</section>
	
	<section class="row">
		
		<section class="col-12 align" ><p style="font-size:22px; font-weight:bold; vertical-align:middle;" class="margin">REPORTE DE EVENTOS O PELIGROS</p><br><br></section>
		
	</section>
	
	<section class="row">
		<section class="col-2"></section>
		<section class="col-8 align"><p class="title margin">ENTREGAR AL JEFE DE SEGURIDAD OPERACIONAL</p></section>
		<section class="col-2"></section>
		
	
	</section>
	<br>
	
	<section class="row">
	    <section class="col-1 pneg borders align"><p class="">Nº de Control:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $vreport_id; ?></p></section>
	    <section class="col-1 pneg borders align"><p class="">Fecha:</p></section>
	    <section class="col-2 pneg borders align"><p><?php echo $date; ?></p></section>
	    <section class="col-6 pneg hd1"><p class="">Tipo de Reporte</p></section>
	</section>    
	
	
	<section class="row ">
		<section class="col-6 pneg hd1">Nombre de quien Detecta:</section>
		<section class="col-2 pneg borders align">Evento: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="tr1" <?php if($reportt=="tr1") echo "checked"; ?>/></section>
		<section class="col-2 pneg borders align">Vulnerabilidad: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="tr4" <?php if($reportt=="tr4") echo "checked"; ?>/></section>
		
	
	</section>
	
	<section class="row ">
		<section class="col-6 pneg borders align"><p><?php echo $reportedby; ?></p></section>
		<section class="col-6">
		    <section class="row">
		    	<section class="col-4 pneg borders align">Peligro: </section>
        		<section class="col-2 pneg borders align margin"><input type="checkbox" value="tr2" <?php if($reportt=="tr2") echo "checked"; ?>/></section>
        		<section class="col-4 pneg borders align">No conformidad: </section>
        		<section class="col-2 pneg borders align margin"><input type="checkbox" value="tr5" <?php if($reportt=="tr5") echo "checked"; ?>/></section>
    		</section>
    		<section class="row">
    		    <section class="col-10 pneg borders align"><p>Oportunidad de Mejora: </p></section>
    		    <section class="col-2 pneg borders align"><input type="checkbox" value="tr3" <?php if($reportt=="tr3") echo "checked"; ?>/></section>
    		</section>
		</section>
	
	</section>
	<!-- Forma de Deteccion -->
	<section class="row ">
		<section class="col-12 pneg hd1 ">Forma de detección:</section>
		
	</section>
	
	
	<section class="row ">
		<section class="col-5 pneg borders align">Auditoria Interna: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd1" <?php if($detect=="fd1") echo "checked"; ?>/></section>
		<section class="col-5 pneg borders align">Reclamos de Clientes: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd5" <?php if($detect=="fd5") echo "checked"; ?>/></section>
	</section>
	
	<section class="row ">
		<section class="col-5 pneg borders align">Auditoría Externa: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd2" <?php if($detect=="fd2") echo "checked"; ?>/></section>
		<section class="col-5 pneg borders align">Revision de Documentos: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd6" <?php if($detect=="fd6") echo "checked"; ?>/></section>
	</section>
	
	<section class="row ">
		<section class="col-5 pneg borders align">Operaciones: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd3" <?php if($detect=="fd3") echo "checked"; ?>/></section>
		<section class="col-5 pneg borders align">Otros: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd7" <?php if($detect=="fd7") echo "checked"; ?>/></section>
	</section>
	
	<section class="row ">
		<section class="col-5 pneg borders align">Vuelo: </section>
		<section class="col-1 pneg borders align margin"><input type="checkbox" value="fd4" <?php if($detect=="fd4") echo "checked"; ?>/></section>
		<section class="col-6 pneg borders align"></section>
		
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
	
	
	<!-- Jefe SMS -->
	
	<section class="row ">
		<section class="col-12 hd1">Jefe SMS</section>
		
	</section>
	
	<section class="row " style="height:100px">
		<section class="col-2 hd1 pneg borders align"><p>fecha: </p></section>
		<section class="col-4 pneg borders align margin"></section>
		<section class="col-2 hd1 pneg borders align"><p>Firma: </p></section>
		<section class="col-4 pneg borders align margin"></section>
	</section>	
		
	<section>
		<p class="hidden" id="rep" style="display:none"><?php echo $report_type_id; ?></p>
		<p class="hidden" id="det" style="display:none"><?php echo $detection_id; ?></p>
	</section>
	</div>
	
</body>
