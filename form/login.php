<?php
	session_start();
	define('DB_SERVER', "localhost");
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', "");
    define('DB_DATABASE', 'mysql');
   
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	
   
   if($_SERVER["REQUEST_METHOD"] === "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT USER_NAME FROM pr_user WHERE USER_NAME = '$myusername' and USER_PASSWORD = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: ../account/myaccount.html");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
    
?>

<html>
	<head>
		<link rel="stylesheet" href="form.css">
		<link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">
	</head>
	
	<header class="logoHeader">
		<div class = "logo">
			<a href = "../index.html"><img src = "../PRLogo.png" class="imgLogo"></a> 
		</div>
	</header>
	
	<div class="centerPage">
		<form action = "login.php" method = "post">
			<div class = "accountInfo">
				<label for="user" class="formLabel">Username/Email:</label>
				<br>
				<input type="text" id="user" class="formInput" name="username">
			</div>
			<div class = "accountInfo">
				<label for="pass" class="formLabel">Password:</label>
				<br>
				<input type="password" id="pass" class="formInput" name="password">
			</div>
	
			<div class = "formLinks">
				<a href = "forgotpassword.html"> Forgot Password? </a>
				<br>
				<a href = "signup.html"> Create Account </a>
			</div>
	
			<div class = "formButton">
				<input type = "submit" value = "Log In"/>
			</div>
		</form>
	</div>
	
	
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>