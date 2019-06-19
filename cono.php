<?php
// mysqli_connect() function opens a new connection to the MySQL server. 
    $dbserver="localhost";
    $dbuser="pinalh";
    $dbpass="";
    $dbname="surveytest";
    
    $conn = mysqli_connect($dbserver, $dbuser, $dbpass, $dbname); 
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } 
?>