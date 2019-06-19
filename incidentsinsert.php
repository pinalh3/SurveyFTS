 <?php
   
    $errorp = ""; // Variable To Store Error Message 
    
    $year=strval(date("Y"));
    $month=strval(date("m"));
    $day=strval(date("d"));
    $phrase="RP";
    $date=date("Y-m-d");

    if (isset($_POST['submit'])) { 
        
        $reportedby=$_POST['reportedby'];
        $reporttype=$_POST['reporttype']; 
        $detection=$_POST['detect']; 
        $description=$_POST['description']; 
        $causes=$_POST['causes'];
        $flight_id=$_POST['flight'];
        
        
        
            if (empty($_POST['reportedby']) || empty($_POST['reporttype']) 
            || empty($_POST['detect']) 
            || empty($_POST['description']) 
            || empty($_POST['causes'])
            ) 
            { 
            $errorp = "Complete all required fields";  
            
            }
               
            else
            {
            
            $sqlsent1="SELECT * FROM vreport;";
    		$result1=mysqli_query($conn, $sqlsent1);
    		$item = mysqli_num_rows($result1);        
                  
            $item1=++$item;
                   
                   
            $reports_id="$phrase$year$month$day$item";
            
            
            $sqlsent2="SELECT * FROM vreport WHERE vreport.vreport_id='$reports_id';";
			$result2=mysqli_query($conn, $sqlsent2);
			$result2check = mysqli_num_rows($result2); 
              
            
			  
			    if ($result2check > 0)
                {
                    $result3check=$result2check;
                    while ($result3check > 0)
                    {
                        $item1=++$item;
                        $reports_id="$phrase$year$month$day$item";
                        //Esto no hace falta
                        
                    }
                    
                }
                
            
            
                $field1 = mysqli_real_escape_string($conn,$reports_id);
                $field2 = mysqli_real_escape_string($conn,$reporttype);
                $field3 = mysqli_real_escape_string($conn,$detection);
                $field4 = mysqli_real_escape_string($conn,$description);
                $field5 = mysqli_real_escape_string($conn,$causes);
                $field6 = mysqli_real_escape_string($conn,$flight_id);
                $field7 = mysqli_real_escape_string($conn,$reportedby);
                $field8 = mysqli_real_escape_string($conn,$date);
                
        
        
        
        
        
         
                $query1 = "INSERT INTO vreport (vreport_id, report_type_id, detection_id, report_description, cause_analisys, flight_id, reporting_crew_id, report_date)
                            VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}','{$field6}','{$field7}','{$field8}')";
                
                $sent1= mysqli_query($conn,$query1);
                
                    if (!$sent1 )
                    {
                    die('Error: ' . mysqli_error($conn));
                    
                    }
                    //end first query
                    else
                    {
                                $errorp="Report ".$reports_id." added";
                                require_once('ip.php');
                                $mess="Report ".$reports_id." added Successfuly";//log message
                                require_once ('log.php'); //including the log function
                                $username=$_SESSION['login_user'];
                                logap($mess, $username, $ip);//function call
                                
                             
                    }
                          
                
            
            }
            
    }
 
              
                    


 
?>
      
        
    
    
    
        