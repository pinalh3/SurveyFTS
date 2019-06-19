 <?php
    $errorp = ""; // Variable To Store Error Message 
    
    

    if (isset($_POST['submit'])) { 
        $date =$_POST['chargedate'];
        $voltbefore =$_POST['voltbefore'];
        $voltafter =$_POST['voltafter'];
        $chargetime =$_POST['chargetime'];
        $chargecurrent =$_POST['chargecurrent'];
        $chargereceived=$_POST['chargereceived'];
        $chargedby =$_POST['chargedby'];
        $flight=$_POST['flight'];
        
       
    
        
        
        if      (!preg_match("/^([01]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/",$chargetime)) {
                $errorp = "invalid time format";
                }
        
        elseif (empty($_POST['chargedate']) || empty($_POST['voltbefore']) 
                || empty($_POST['voltafter']) 
                || empty($_POST['chargetime']) 
                || empty($_POST['chargecurrent'])
                || empty($_POST['chargereceived'])
                || empty($_POST['chargedby'])
                || empty($_POST['selectbatt']))
                { 
                $errorp = "Complete all required fields";  
                echo $errorp;
                }
                else
                {
                
             			        
    	           
    
$field1 = mysqli_real_escape_string($conn,$_POST['selectbatt']);
$field2 = mysqli_real_escape_string($conn,$_POST['chargedate']);
$field3 = mysqli_real_escape_string($conn,$_POST['voltbefore']);
$field4 = mysqli_real_escape_string($conn,$_POST['voltafter']);
$field5 = mysqli_real_escape_string($conn,$_POST['chargetime']);
$field6 = mysqli_real_escape_string($conn,$_POST['chargecurrent']);
$field7 = mysqli_real_escape_string($conn,$_POST['chargereceived']);
$field8 = mysqli_real_escape_string($conn,$_POST['chargedby']);
$field9 = mysqli_real_escape_string($conn,$flight);


 
$query = "INSERT INTO charge (batteries_id, date_charge, bvolt_before, bvolt_after, chargin_duration, chargin_current,charge_received,crew_id, flight_id)
            VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}','{$field6}','{$field7}','{$field8}' ,'{$field9}')";
 
$sent= mysqli_query($conn,$query);

if (!$sent) {
die('Error: ' . mysqli_error($conn));
    
}
else
{
$errorp="record added";
}


}}
?>
      
        
        
        