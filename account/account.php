<?php
	session_start();
    include_once '../classes/Dao.php';
    
    $dao = new Dao();
   
	$myusername = $_SESSION['login_user'];
	$count = $dao->getNumUser($myusername);
      
    // If result matched $myusername and $mypassword, table row must be 1 row
		
    if($count != 1) {
		header("location: ../form/login.php");
    }
	
	if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['logout'])) {
		unset($_SESSION['login_user']);
        if(isset($_SESSION['first_result'])){
            unset($_SESSION['first_result']);
        }
		header("location: ../form/login.php");
	}	
?>