<?php
	include_once '../classes/Dao.php';
    include_once 'form.php';
	$dao = new Dao();

	if(!isset($givenLogin)){
		$givenLogin = "";
	}
	
	
   $error = "";
   if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['loginSubmit'])) {
      // username and password sent from form 
      
      $myusername = $_POST['username'];
	  $_SESSION["GIVEN_LOGIN"] = $myusername;
	  $givenLogin = $myusername;
      $mypassword = hash('sha512', $_POST['password'] . 'x!zral78u1xD');
      
      $count = $dao->getNumUserWithPass($myusername, $mypassword);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: ../account/myaccount.php");
      }else {
         $error = "Your username/password is incorrect";
		  unset($_POST);
      }
   }
  
    
?>

<html>
	<head>
		<link rel="stylesheet" href="form.css">
		<link href="https://fonts.googleapis.com/css?family=Baloo|Bitter" rel="stylesheet">
		<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		<script type="text/javascript" src="formerror.js"></script>
		<script type="text/javascript" src="../js/jquery.validate.js"></script>
		<script type="text/javascript" src="login.js"></script>
	</head>
	
	<header class="logoHeader">
		<div class = "logo">
			<a href = "../index.php"><img src = "../PRLogo.png" class="imgLogo"></a> 
		</div>
	</header>
	
	
	<div class="centerPage">
		<?php echo '<div class = "formError"><p>' . htmlspecialchars($error) . '</p></div>' ?>
		<form action = "" method = "post" id="loginForm">
		
			<div class = "accountInfo">
				<label for="user" class="formLabel">Username:</label>
				<br>
				<input type="text" id="user" class="formInput" name="username" value="<?php echo $givenLogin ?>">
			</div>
			<div class = "accountInfo">
				<label for="pass" class="formLabel">Password:</label>
				<br>
				<input type="password" id="pass" class="formInput" name="password">
			</div>
	
			<div class = "formLinks">
				<a href = "forgotpassword.html"> Forgot Password? </a>
				<br>
				<a href = "signup.php"> Create Account </a>
			</div>
	
			<div>
				<input type = "submit" class = "formButton" name = "loginSubmit" value = "Log In"/>
			</div>
		</form>
	</div>
	
	
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>