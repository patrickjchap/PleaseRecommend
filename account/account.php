<?php
	session_start();
	define('DB_SERVER', "localhost");
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', "");
    define('DB_DATABASE', 'mysql');
   
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
	$myusername = $_SESSION['login_user'];
	$sql = "SELECT USER_NAME, USER_FNAME, USER_EMAIL FROM pr_user WHERE USER_NAME = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	
	$name = $row['USER_FNAME'];
	$email = $row['USER_EMAIL'];
	
	$count = mysqli_num_rows($result);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
		
    if($count != 1) {
		header("location: ../form/login.php");
    }
	
	if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logout'])) {
		unset($_SESSION['login_user']);
		header("location: ../form/login.php");
	}	
?>