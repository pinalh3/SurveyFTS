 <?php
   
    $errorp = ""; // Variable To Store Error Message 
    
    

    if (isset($_POST['submit'])) { 
        
        $date=$_POST['fdate'];
        $stime=$_POST['start_time']; 
        $etime=$_POST['end_time']; 
        $timeoflight=$_POST['time_flight']; 
        $uav=$_POST['uav'];
        $battery=$_POST['battery'];
        $payload=$_POST['payload'];
        $antenna=$_POST['antenna'];
        $batteryuse=$_POST['battery_usage'];
        $windspeed=$_POST['windspeed'];
        $ftemperature=$_POST['flight_temperature'];
        $wconditions=$_POST['weather_condition'];
        $oparea=$_POST['operations_area'];
        $opobj=$_POST['operations_objective'];
        $launchingp=$_POST['launchingp'];
        $landingp=$_POST['landingp'];
        $operator=$_POST['operator'];
        $technic=$_POST['technic'];
        $parachuter=$_POST['parachuter'];
        $uavresp=$_POST['uavresp'];
        $maxheight=$_POST['max_height'];
        $comments=$_POST['comments'];
        $damageid=$_POST['damaget'];
        $damaged=$_POST['damadesc'];
        $releasebefore=$_POST['releasech'];
        $releaseafter=$_POST['releaseact'];
        $voltage_drop=$_POST['voltage_drop'];
        
        
        
        
        
        
            if (empty($_POST['fdate']) || empty($_POST['start_time']) 
            || empty($_POST['end_time']) 
            || empty($_POST['time_flight']) 
            || empty($_POST['uav'])
            || empty($_POST['battery'])
            || empty($_POST['payload'])
            || empty($_POST['antenna'])
            || empty($_POST['battery_usage'])
            || empty($_POST['windspeed'])
            || empty($_POST['flight_temperature'])
            || empty($_POST['weather_condition'])
            || empty($_POST['operations_area'])
            || empty($_POST['operations_objective'])
            || empty($_POST['launchingp'])
            || empty($_POST['landingp'])
            || empty($_POST['operator'])
            || empty($_POST['technic'])
            || empty($_POST['parachuter'])
            || empty($_POST['uavresp'])
            || empty($_POST['releasech'])
            || empty($_POST['releaseact'])
            || empty($_POST['voltage_drop'])
            ) 
            { 
            $errorp = "Complete all required fields";  
            
            }
            else if (!preg_match("/^[0-9 ]*$/",$batteryuse)) 
            {
            $errorp = "Only numbers allowed on Battery Usage";
            
            }
            else if (!preg_match("/^[0-9 ]*$/",$voltage_drop)) 
            {
            $errorp = "Only numbers allowed on Voltage Drop";
            
            }
            elseif (!preg_match("/^[0-9 ]*$/",$windspeed)) 
            {
            $errorp = "Only numbers allowed on Windspeed";
            
            }
            elseif (!preg_match("/^[0-9 ]*$/",$ftemperature)) 
            { 
            $errorp = "Only numbers allowed on Temperature";  
            
            }
            elseif (!preg_match("/^[0-9 ]*$/",$maxheight)) 
            { 
            $errorp = "Only numbers allowed on Max Height Reached";  
            
            }        
            elseif (!preg_match("/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$stime)) 
            { 
            $errorp = "Verify time format HH:MM:SS on start time";  
            
            }            
            elseif (!preg_match("/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$etime)) 
            { 
            $errorp = "Verify time format HH:MM:SS on end time";  
            
            }            
            elseif (!preg_match("/^([0-1][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$timeoflight)) 
            { 
            $errorp = "Verify time format HH:MM:SS time of flight";  
            
            }            
            else
            {
            
            //inicio count
            
                
                        //Date
                        $sqlsentdate="SELECT MAX( fdate ) AS fecha
    									FROM flightslog AS b
    									WHERE b.uav_id =$uav";
    			            $resultdate=mysqli_query($conn, $sqlsentdate);
    			            
    			            
    			            
    			            
    			            $resultcheckdate = mysqli_num_rows($resultdate); 
                			 if ($resultcheckdate > 0)
                            {
                            	
                                while ($row = mysqli_fetch_assoc($resultdate))
                                {
                                	$maxdate=$row['fecha'];
                                	
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
                            	
                                while ($row = mysqli_fetch_assoc($resulttime))
                                {
                                	$maxtime=$row['tiempo'];
                                	
                                }
                                
                            }
                            
                            
                        $d='YES';    
                        
                        if(strcasecmp($releaseafter,$d) == 0)
                        {
                            $releasecount="0";
                            
                        }
                        elseif (strcasecmp($releasebefore,$d) == 0)
                        {
                            $releasecount="1";
                           
                            
                            
                        }
                        else
                        {
                           	
                            
                            
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
                                while ($row = mysqli_fetch_assoc($resultrel))
                                {
                                  $count=$row['release_count'];  
                                  
                                  $releasecount=++$count;
                                  
                                }
                                if($count>=5)
                                {
                                    $relalert="Release must be changed";
                                    //alert
                                }
                            }
                            else
                            {
                              $releasecount=1; 
                              
                            }
                            
                        }
                       
            
            
            
            
            
            
            
            
            
            //fin count
            
            if (($maxdate==$date && $maxtime<$stime) || $maxdate<$date)
            {
            
            
             $sqlsentuav="SELECT *
    									FROM uav AS b
    									WHERE b.uav_id =$uav";
    			            $resultuav=mysqli_query($conn, $sqlsentuav);
    			            
    			            
    			            
    			            
    			            $resultcheckuav = mysqli_num_rows($resultuav); 
                			 if ($resultcheckuav > 0)
                            {
                            	
                                while ($row = mysqli_fetch_assoc($resultuav))
                                {
                                	$uavserial=$row['uav_serial'];
                                	
                                }
                                
                            }
                    
            $sqlsent1="SELECT * FROM flightslog;";
    		$result1=mysqli_query($conn, $sqlsent1);
    		$item = mysqli_num_rows($result1);        
                  
            $item1=++$item;
                   
                   
            $flights_id="FL".$item."";
            
            $sqlsent2="SELECT * FROM flightslog WHERE flightslog.flights_id='$flights_id';";
			$result2=mysqli_query($conn, $sqlsent2);
			$result2check = mysqli_num_rows($result2); 
              
            
			  
			    if ($result2check > 0)
                {
                    $result3check=$result2check;
                    while ($result3check > 0)
                    {
                        $item1=++$item;
                        $flights_id="FL".$item."";
                        //Esto no hace falta
                        $sqlsent3="SELECT flights_id FROM flightslog where flightslog.flights_id='$flights_id';";
			            $result3=mysqli_query($conn, $sqlsent3);
			            $result3check = mysqli_num_rows($result3); 
                    }
                    
                }
                
            
            
                $field1 = mysqli_real_escape_string($conn,$flights_id);
                $field2 = mysqli_real_escape_string($conn,$uav);
                $field3 = mysqli_real_escape_string($conn,$battery);
                $field4 = mysqli_real_escape_string($conn,$payload);
                $field5 = mysqli_real_escape_string($conn,$date);
                $field6 = mysqli_real_escape_string($conn,$stime);
                $field7 = mysqli_real_escape_string($conn,$etime);
                $field8 = mysqli_real_escape_string($conn,$wconditions);
                $field9 = mysqli_real_escape_string($conn,$opobj);
                $field10 = mysqli_real_escape_string($conn,$antenna);
                $field11 = mysqli_real_escape_string($conn,$windspeed);
                $field12 = mysqli_real_escape_string($conn,$ftemperature);
                $field13= mysqli_real_escape_string($conn,$timeoflight);
                $field14= mysqli_real_escape_string($conn,$batteryuse);
                $field15 = mysqli_real_escape_string($conn,$maxheight);
                $field16= mysqli_real_escape_string($conn,$comments);
                $field17= mysqli_real_escape_string($conn,$oparea);
                
                $field18 = mysqli_real_escape_string($conn,$launchingp);
                $field19= mysqli_real_escape_string($conn,$landingp);
                $field20= mysqli_real_escape_string($conn,$operator);
                $field21 = mysqli_real_escape_string($conn,$technic);
                $field22= mysqli_real_escape_string($conn,$parachuter);
                $field23= mysqli_real_escape_string($conn,$uavresp);
                $field24= mysqli_real_escape_string($conn,$damageid);
                $field25= mysqli_real_escape_string($conn,$damaged);
                
                $field26= mysqli_real_escape_string($conn,$voltage_drop);
                
                
        
        
        
        
        
         
                $query1 = "INSERT INTO flightslog (flights_id, uav_id, batteries_id, payload_id, fdate, start_time, end_time, wconditions_id, opeobj_id, antenna_id, windspeed, flight_temperature, time_flight, battery_usage, maxheight, comments, operation_area_id, voltage_drop)
                            VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}','{$field6}','{$field7}','{$field8}','{$field9}','{$field10}','{$field11}','{$field12}','{$field13}','{$field14}','{$field15}','{$field16}','{$field17}' ,'{$field26}')";
                
                $sent1= mysqli_query($conn,$query1);
                
                    if (!$sent1 )
                    {
                    die('Error: ' . mysqli_error($conn));
                    
                    }
                    //end first query
                    else
                    {
                        $query2 = "INSERT INTO launch_location (flights_id, locations_id)
                                    VALUES ('{$field1}','{$field18}')";
                                    
                        $sent2= mysqli_query($conn,$query2);
                        
                       
                        $query3 = "INSERT INTO land_location (flights_id, locations_id)
                            VALUES ('{$field1}','{$field19}')";
                            
                        $sent3= mysqli_query($conn,$query3);
                        
                        
                        $query4 = "INSERT INTO operator (op_crew_id,flights_id)
                            VALUES ('{$field20}','{$field1}')";
                    
                        $sent4= mysqli_query($conn,$query4);
                        
                        
                        $query5 = "INSERT INTO technic (flights_id, tc_crew_id)
                                VALUES ('{$field1}','{$field21}')";
                                
                        $sent5= mysqli_query($conn,$query5);
                        
                        
                        $query6 = "INSERT INTO parachuter (flight_id, p_crew_id)
                            VALUES ('{$field1}','{$field22}')";
                    
                        $sent6= mysqli_query($conn,$query6);
                        
                        $query7 = "INSERT INTO uav_responsible (flight_id, uav_crew_id)
                            VALUES ('{$field1}','{$field23}')";
                            
                        $sent7= mysqli_query($conn,$query7); 
                        
                        if(strcasecmp($releaseafter,$d) == 0)
                        {
                            $relafter="1";
                        }
                        else
                        {
                            $relafter="0";
                        }
                        
                        if (strcasecmp($releasebefore,$d) == 0)
                        { 
                            $relbefore="1";
                        }
                        else
                        {
                            $relbefore="0";
                        }
                        $field26= mysqli_real_escape_string($conn,$relbefore);
                        $field27= mysqli_real_escape_string($conn,$relafter);
                        
                        
                        $query8 = "INSERT INTO release_control (flights_id, release_before, release_after,release_count)
                            VALUES ('{$field1}','{$field26}','{$field27}','{$releasecount}')";
                            
                        $sent8= mysqli_query($conn,$query8); 
                        
                        if (!$sent2 || !$sent3 || !$sent4 || !$sent5 || !$sent6 || !$sent7 || !$sent8 )
                        {
                        die('Error: ' . mysqli_error($conn));
                        
                        }
                        //end six query
                        
                        elseif (!empty($_POST['damaget']) && !empty($_POST['damadesc']))    
                        {
                        $query9 = "INSERT INTO damages (flight_id, damage_type_id, damage_description)
                            VALUES ('{$field1}','{$field24}','{$field25}')";
                            
                        $sent9= mysqli_query($conn,$query9); 
                                
                            if (!$sent9)
                            {
                            die('Error: ' . mysqli_error($conn));
                            
                            }
                            else
                            {
                                $errorp="flight log ".$flights_id." added $relalert";
                                
                            }
                        }
                        else
                        {
                            $errorp="flight log ".$flights_id." added $relalert";
                            
                        }
                          
                }            
                $releasemsg="Release Count for UAV $uavserial is $releasecount";            
                }   
                else
                {
                    $errorp="date or start time are lower than last register";
                }
            
            
            
            }
            echo "$maxdate/$date  $maxtime/$stime";
            }    
               

 
              
                    


 
?>
      
        
        
        