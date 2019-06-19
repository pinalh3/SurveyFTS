 <?php
    $errorp = ""; // Variable To Store Error Message 
    
    

    if (isset($_POST['submit'])) { 
        $serial =$_POST['serial'];
        $voltage =$_POST['voltage'];
        $capacity =$_POST['capacity'];
        $firstsuse =$_POST['firstsuse'];
        $purchasedate =$_POST['purchasedate'];
        $status=$_POST['status'];
        
        
    
        
        
        if      (!preg_match("/^[0-9 ]*$/",$capacity)) {
                $errorp = "Only numbers allowed on capacity";
                }
        elseif (!preg_match("/^[0-9 ]*$/",$cells)) {
                $errorp = "Only numbers allowed on cells";
                }
        elseif (empty($_POST['serial']) || empty($_POST['voltage']) 
                || empty($_POST['cells']) 
                || empty($_POST['capacity']) 
                || empty($_POST['purchasedate'])
                || empty($_POST['status'])
                ) 
                { 
                $errorp = "Complete all required fields";  
                echo $errorp;
                }
                
                
              $sqlsent4="SELECT * FROM batteries where batt_serial=$serial;";
			   $result4=mysqli_query($conn, $sqlsent4);
			   $result4check = mysqli_num_rows($result4);   
			   echo $result4check;
                if ($result4check == 0)
                    {    			        
    	           
    
$field1 = mysqli_real_escape_string($conn,$_POST['serial']);
$field2 = mysqli_real_escape_string($conn,$_POST['voltage']);
$field3 = mysqli_real_escape_string($conn,$_POST['cells']);
$field4 = mysqli_real_escape_string($conn,$_POST['capacity']);
$field5 = mysqli_real_escape_string($conn,$_POST['firstsuse']);
$field6 = mysqli_real_escape_string($conn,$_POST['purchasedate']);
$field7 = mysqli_real_escape_string($conn,$_POST['status']);


 
$query = "INSERT INTO batteries (batt_serial, voltage, cells, capacity, first_use, purchase_date,status_id)
            VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}','{$field6}','{$field7}')";
 
$sent= mysqli_query($conn,$query);

if (!$sent) {
die('Error: ' . mysqli_error($conn));
    
}
echo "record added";
}
else
{
$errorp="serial is allready included"; 
    	            } 
              
                    

mysqli_close($conn);
}
?>
      
        
        
        