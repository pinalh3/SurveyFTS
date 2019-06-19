 <?php
   
    $errorp = ""; // Variable To Store Error Message 
    
    

    if (isset($_POST['submit'])) { 
        
        $action_id=$_POST['act'];
        $change=$_POST['change']; 
        $observation=$_POST['observation']; 
        $status=$_POST['status']; 
        
        
        $year=strval(date("Y"));
        $month=strval(date("m"));
        $day=strval(date("d"));
        $phrase="ACT";
        $date=date("Y-m-d");
        $phrase="TRK";
        
        
            if (empty($_POST['act']) || empty($_POST['change']) 
            || empty($_POST['observation']) 
            
            ) 
            { 
            $errorp = "Complete all required fields";  
            
            }
               
            else
            {
            if($status=="closed")
            {
                $errorp="The action has already been closed a cannot be updated";
            }
            else
            {
            $sqlsent1="SELECT * FROM action_effectiveness;";
    		$result1=mysqli_query($conn, $sqlsent1);
    		$item = mysqli_num_rows($result1);        
                  
            $item1=++$item;
                   
                   
            $action_effect_id="$phrase$year$month$day$item";
            
            
            $sqlsent2="SELECT * FROM action WHERE action.action_id='$action_effect_id';";
			$result2=mysqli_query($conn, $sqlsent2);
			$result2check = mysqli_num_rows($result2); 
              
            
			  
			    if ($result2check > 0)
                {
                    $result3check=$result2check;
                    while ($result3check > 0)
                    {
                        $item1=++$item;
                        $action_effect_id="$phrase$year$month$day$item";
                        //Esto no hace falta
                        
                    }
                    
                }
                
            
            if($change=="Conforme")
            {
                
                $queryupdate="UPDATE action SET action_status_id =2 WHERE action.action_id='$action_id'"; 
                $sentupdate= mysqli_query($conn,$queryupdate);
                $changed="YES";
                
                if (!$sentupdate)
                {
                    die('Error: ' . mysqli_error($conn));
                }
                
            }
            else
            {
                $changed="NO";
            }
            
                $field1 = mysqli_real_escape_string($conn,$action_id);
                $field2 = mysqli_real_escape_string($conn,$changed);
                $field3 = mysqli_real_escape_string($conn,$observation);
                $field4 = mysqli_real_escape_string($conn,$date);
                $field5 = mysqli_real_escape_string($conn,$action_effect_id);
                
                
        
                
                $query1 = "INSERT INTO action_effectiveness (action_effect_id, action_id, verification_date, status_changed, observations)
                            VALUES ('{$field5}','{$field1}','{$field4}','{$field2}','{$field3}')";
                
                echo "$query1";
                
                $sent1= mysqli_query($conn,$query1);
                
                    if (!$sent1 )
                    {
                    die('Error: ' . mysqli_error($conn));
                    
                    }
                    //end first query
                    else
                    {
                                $errorp="Action Trace".$action_effect_id." for action ".$action_id." added";
                                require_once('ip.php');
                                $mess="Action Trace".$action_effect_id." for action ".$action_id." added Successfuly";//log message
                                require_once ('log.php'); //including the log function
                                $username=$_SESSION['login_user'];
                                logap($mess, $username, $ip);//function call
                                
                             
                        }
                        
                        
                               
                                
                             
                    }
            }       
                
    }     

              
                    


 
?>
      
        
    
    
    
        