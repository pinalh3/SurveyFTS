 <?php
    $errorp = ""; // Variable To Store Error Message 
    
    

    if (isset($_POST['submit'])) { 
        $dni =$_POST['dni'];
        $firstname =$_POST['firtsname'];
        $secondname =$_POST['secondname'];
        $firstsurname =$_POST['firstsurname'];
        $secondsurname =$_POST['secodsurname'];
        $emergencyc =$_POST['emergencyc'];
        
    
        
        
        if (!preg_match("/^[0-9 ]*$/",$dni)) {
                $errorp = "Only numbers allowed on dni";
                }
        elseif (!preg_match("/^[a-zA-Z ]*$/",$firstname)
                || !preg_match("/^[a-zA-Z ]*$/",$secondname) 
                || !preg_match("/^[a-zA-Z ]*$/",$firstsurname)
                || !preg_match("/^[a-zA-Z ]*$/",$secondsurname)
                || !preg_match("/^[a-zA-Z ]*$/",$emergencyc)) 
                {
                $errorp = "Only letters and white space allowed on names";
                }
        elseif (empty($_POST['dni']) || empty($_POST['firstname']) 
                || empty($_POST['firstname']) 
                || empty($_POST['firstsurname']) 
                || empty($_POST['birthdate'])
                || empty($_POST['city'])  
                || empty($_POST['address'])
                || empty($_POST['emergencyc'])) 
                { 
                $errorp = "Complete all required fields";  
                echo $errorp;
                }
                
                
              $sqlsent4="SELECT * FROM crew where dni=$dni;";
			   $result4=mysqli_query($conn, $sqlsent4);
			   $result4check = mysqli_num_rows($result4);   
			   echo $result4check;
                if ($result4check == 0)
                    {    			        
    	           
    
$field1 = mysqli_real_escape_string($conn,$_POST['dni']);
$field2 = mysqli_real_escape_string($conn,$_POST['firstname']);
$field3 = mysqli_real_escape_string($conn,$_POST['secondname']);
$field4 = mysqli_real_escape_string($conn,$_POST['firstsurname']);
$field5 = mysqli_real_escape_string($conn,$_POST['secondsurname']);
$field6 = mysqli_real_escape_string($conn,$_POST['address']);
$field7 = mysqli_real_escape_string($conn,$_POST['city']);
$field8 = mysqli_real_escape_string($conn,$_POST['birthdate']);
$field9 = mysqli_real_escape_string($conn,$_POST['emergencyc']);
 
$query = "INSERT INTO crew (dni, first_name, middle_name, first_surname, second_surname, address, city_id, birthdate, emergency_cont)
            VALUES ('{$field1}','{$field2}','{$field3}','{$field4}','{$field5}','{$field6}','{$field7}','{$field8}','{$field9}')";
 
$sent= mysqli_query($conn,$query);

if (!$sent) {
die('Error: ' . mysqli_error($conn));
    
}
echo "record added";
}
else
{
$errorp="DNI is allready included"; 
    	            } 
              
                    

mysqli_close($conn);
}
?>
      
        
        
        