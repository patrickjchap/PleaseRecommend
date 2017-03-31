<?php
	session_start();
    include_once '../classes/Dao.php';
    $dao = new Dao();
	
	if(isset($_SESSION['login_user'])){
		$tmpusername = $_SESSION['login_user'];
		$tmpcount = $dao->getNumUser($tmpusername);
		
		if($tmpcount == 1){
			header("location: ../account/myaccount.php");
		}
	}
?>