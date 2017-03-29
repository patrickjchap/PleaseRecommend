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
	
	
	
   $error = "";
   if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['loginSubmit'])) {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,hash('sha512', $_POST['password']));
      
      $sql = "SELECT USER_NAME FROM pr_user WHERE USER_NAME = '$myusername' and USER_PASSWORD = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      $count = mysqli_num_rows($result);
      
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
		<link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">
	</head>
	
	<header class="logoHeader">
		<div class = "logo">
			<a href = "../index.php"><img src = "../PRLogo.png" class="imgLogo"></a> 
		</div>
	</header>
	
	
	<div class="centerPage">
		<?php echo '<div class = "formError"><p>' . htmlspecialchars($error) . '</p></div>' ?>
		<form action = "" method = "post">
		
			<div class = "accountInfo">
				<label for="user" class="formLabel">Username:</label>
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