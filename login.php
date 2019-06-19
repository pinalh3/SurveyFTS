    <?php
    include ('ip.php');
    
    session_start(); // Starting Session 
    $error = ''; // Variable To Store Error Message 
    if (isset($_POST['submit'])) { 
    if (empty($_POST['user']) || empty($_POST['pass'])) { 
    $error = "Username or Password is invalid"; 
    } 
    else{ 
    // Define $username and $password 
    $username = $_POST['user']; 
    $password = $_POST['pass']; 
    // mysqli_connect() function opens a new connection to the MySQL server. 
    $conn = mysqli_connect("localhost", "pinalh", "", "surveytest"); 
    // SQL query to fetch information of registerd users and finds user match. 
    $query = "SELECT user, pass from userpass where user=? AND pass=? LIMIT 1"; 
    // To protect MySQL injection for Security purpose 
    $stmt = $conn->prepare($query); 
    $stmt->bind_param("ss", $username, $password); 
    $stmt->execute(); 
    $stmt->bind_result($username, $password); 
    $stmt->store_result(); 
    if($stmt->fetch()) //fetching the contents of the row { 
    {$_SESSION['login_user'] = $username; // Initializing Session 
    $mess="--Login Successful--";//log message
    require_once ('log.php'); //including the log function
    
    logap($mess, $username, $ip);//function call
    
    
    header("location: menu1.php"); // Redirecting To Profile Page 
    
    } 
    else { 
    $error = "Username or Password invalid"; 
    } 
    mysqli_close($conn); // Closing Connection 
    } 
    }
    ?>