 <?php
   
    $errorp = ""; // Variable To Store Error Message 
    
    

    if (isset($_POST['submit'])) { 
        
        $report_id=$_POST['reportid'];
        $actiontype=$_POST['actiontype']; 
        $description=$_POST['description']; 
        $responsible=$_POST['resp'];
        $deadline=$_POST['deadline'];
        $actionstatus=1;
        
        $year=strval(date("Y"));
        $month=strval(date("m"));
        $day=strval(date("d"));
        $phrase="ACT";
        $date=date("Y-m-d");
        
        
            if (empty($_POST['reportid']) || empty($_POST['actiontype']) 
            || empty($_POST['description']) 
            || empty($_POST['resp']) 
            || empty($_POST['deadline'])
            ) 
            { 
            $errorp = "Complete all required fields";  
            
            }
               
            else
            {
            
            $sqlsent1="SELECT * FROM action;";
    		$result1=mysqli_query($conn, $sqlsent1);
    		$item = mysqli_num_rows($result1);        
                  
            $item1=++$item;
                   
                   
            $action_id="$phrase$year$month$day$item";
            
            
            $sqlsent2="SELECT * FROM action WHERE action.action_id='$action_id';";
			$result2=mysqli_query($conn, $sqlsent2);
			$result2check = mysqli_num_rows($result2); 
              
            
			  
			    if ($result2check > 0)
                {
                    $result3check=$result2check;
                    while ($result3check > 0)
                    {
                        $item1=++$item;
                        $action_id="$phrase$year$month$day$item";
                        //Esto no hace falta
                        
                    }
                    
                }
                
            
            
                $field1 = mysqli_real_escape_string($conn,$action_id);
                $field2 = mysqli_real_escape_string($conn,$report_id);
                $field3 = mysqli_real_escape_string($conn,$actiontype);
                $field4 = mysqli_real_escape_string($conn,$description);
                $field5 = mysqli_real_escape_string($conn,$date);
                $field6 = mysqli_real_escape_string($conn,$actionstatus);
                
                $field7 = mysqli_real_escape_string($conn,$responsible);
                $field8 = mysqli_real_escape_string($conn,$deadline);
                
        
        
        
        
                
                $query1 = "INSERT INTO action (action_id, vreport_id, action_type_id, action_description, action_date, action_status_id)
                            VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}','{$field6}')";
                
                echo "$query1";
                
                $sent1= mysqli_query($conn,$query1);
                
                    if (!$sent1 )
                    {
                    die('Error: ' . mysqli_error($conn));
                    
                    }
                    //end first query
                    else
                    {
                        $query2 = "INSERT INTO action_responsible (crew_id,  action_id,  limit_date)
                            VALUES ('{$field7}','{$field1}','{$field8}')";
                
                        $sent2= mysqli_query($conn,$query2);
                
                        if (!$sent2 )
                        {
                        die('Error: ' . mysqli_error($conn));
                        
                        }
                        //end second query
                        else
                        {
                        
                        
                        
                                $errorp="Action ".$action_id." added";
                                require_once('ip.php');
                                $mess="Action ".$action_id." added Successfuly";//log message
                                require_once ('log.php'); //including the log function
                                $username=$_SESSION['login_user'];
                                logap($mess, $username, $ip);//function call
                                
                             
                        }
                        
                        
                               
                                
                             
                    }
                          
                
            
            }
            
    }
 
              
                    


 
?>
      
        
    
    
    
        