<?php
	session_start();
	define('DB_SERVER', "localhost");
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', "");
    define('DB_DATABASE', 'mysql');
   
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	
	if(isset($_SESSION['login_user'])){
		$tmpusername = $_SESSION['login_user'];
		$tmpsql = "SELECT USER_NAME FROM pr_user WHERE USER_NAME = '$tmpusername'";
		$tmpresult = mysqli_query($db,$tmpsql);
		$tmprow = mysqli_fetch_array($tmpresult,MYSQLI_ASSOC);
	
		$tmpcount = mysqli_num_rows($tmpresult);
		if($tmpcount == 1){
			header("location: ../account/myaccount.php");
		}
	}
?>