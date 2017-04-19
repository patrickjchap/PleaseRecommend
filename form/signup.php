<?php
	include_once 'form.php';
	include_once '../classes/Dao.php';
	
	$dao = new Dao();
	
	$error = "";
    $userError = "";
    $emailError = "";
    $repemailError = "";
    $fnameError = "";
    $lnameError = "";
    $passwordError = "";
    $reppasswordError = "";
    $totalError = "";
    
   if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['createSubmit'])) {
      $totalError = "";
      $signUpError = false;
	  
	  //check for user input
	  $username = "";
	  $userError = "";
	  if($_POST['desired_username'] != ""){
			//check to see if username is taken
			$username = htmlspecialchars($_POST['desired_username']);
			$count = $dao->getNumUser($username);
			
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)){
					$userError = "Username cannot contain special characters or spaces.";
					$signUpError = true;
			}
	
			if($count >= 1){
					$userError = "Username is already taken";
					$signUpError = true;
			}
	  }else {
            $userError = "Username cannot be blank.";
			$signUpError = true;
	  }
	  
	  //check for email input
	  $emailname = "";
	  $emailError = "";
	  if($_POST['desired_email'] != ""){
			//check to see if email is taken
			$emailname = htmlspecialchars($_POST['desired_email']);
			$count = $dao->getNumEmail($emailname);
			
			$tmpemail = filter_var($emailname, FILTER_SANITIZE_EMAIL);
			
			if ($tmpemail != $emailname){
					$emailError = "Email contains illegal characters.";
					$signUpError = true;
			}
     
			if($count >= 1){
					$emailError = "Email is already taken";
					$signUpError = true;
			}
	  }else{
            $emailError = "Email cannot be blank.";
			$signUpError = true;
	  }
      
      //check for repeat email input
	  $repemailname = "";
	  $repemailError = "";
	  if($_POST['repdesired_email'] != ""){
			//check to see if email is taken
			$repemailname = htmlspecialchars($_POST['repdesired_email']);
			
			if ($repemailname != $emailname){
					$emailError = "Emails do not match.";
					$signUpError = true;
			}
     
	  }else{
            $repemailError = "Must repeat email.";
			$signUpError = true;
	  }
      
      //check for fname input
	  $fnamename = "";
	  $fnameError = "";
	  if($_POST['desired_fname'] != ""){
			//check to see if email is taken
			$fnamename = htmlspecialchars($_POST['desired_fname']);
			
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $fnamename)){
					$fnameError = "First name cannot contain special characters.";
					$signUpError = true;
			}
     
	  }else{
            $fnameError = "First Name cannot be empty.";
			$signUpError = true;
	  }
      
      //check for lname input
	  $lnamename = "";
	  $lnameError = "";
	  if($_POST['desired_lname'] != ""){
			//check to see if email is taken
			$lnamename = htmlspecialchars($_POST['desired_lname']);
			
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $lnamename)){
					$lnameError = "Last name cannot contain special characters.";
					$signUpError = true;
			}
     
	  }else{
            $lnameError = "Last Name cannot be empty.";
			$signUpError = true;
	  }
      
      $passwordname = "";
      $passwordError = "";
      if($_POST['desired_pass'] != ""){
            $passwordname = htmlspecialchars($_POST['desired_pass']);
      }else{
            $passwordError = "Password cannot be blank.";
            $signUpError = true;
      }
      
      $reppasswordname = "";
      $reppasswordError = "";
      if($_POST['repdesired_pass'] != ""){
            $reppasswordname = htmlspecialchars($_POST['repdesired_pass']);
            if($reppasswordname  != $passwordname){
                    $passwordError = "Passwords do not match.";
                    $signUpError = true;
            }
      }else{
            $passwordError = "Password cannot be blank.";
            $signUpError = true;
      }
      
      if(!$signUpError){
            $hashpass = hash('sha512', $passwordname . 'x!zral78u1xD');
            
            $dao->createUser($username, $hashpass, $emailname, $fnamename, $lnamename);          
      
            $_SESSION['login_user'] = $myusername;
         
            header("location: ../account/myaccount.php");
            
      }
   }else{
        $totalError = "All fields must be filled out.";
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

	<form action = "" method = "post">
		<div class="centerPage">
            <div>
                <?php echo $totalError ?>
            </div>
			<div class = "accountInfo">
				<label for="user" class=
					<?php if($userError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>Username: <?php echo $userError ?></label>
				<br>
				<input type="text" id="user" class="formInput" name="desired_username">
			</div>
	
			<div class = "accountInfo">
				<label for="user" class=
					<?php if($emailError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>Email: <?php echo $emailError ?></label>
				<br>
				<input type="text" id="email" class="formInput" name="desired_email">
			</div>
	
			<div class = "accountInfo">
				<label for="user" class=
					<?php if($repemailError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>Repeat Email: <?php echo $repemailError ?></label>
				<br>
				<input type="text" id="repEmail" class="formInput" name="repdesired_email">
			</div>
	
			<div class= "accountInfo">
				<label for="user" class=
					<?php if($fnameError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>First Name: <?php echo $fnameError ?></label>
				<br>
				<input type="text" id="fName" class="formInput" name="desired_fname">
			</div>
	
			<div class = "accountInfo">
				<label for="user" class=
					<?php if($lnameError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>Last Name: <?php echo $lnameError ?></label>
				<br>
				<input type="text" id="lName" class="formInput" name="desired_lname">
			</div>
	
			<div class = "accountInfo">
				<label for="user" class=
					<?php if($passwordError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>Password: <?php echo $passwordError ?></label>
				<br>
				<input type="password" id="pass" class="formInput" name="desired_pass">
			</div>
	
			<div class = "accountInfo">
				<label for="user" class=
					<?php if($reppasswordError == ""){
						echo '"formLabel"';
					}else{
						echo '"formLabelError"';
					} ?>
					>Repeat Password: <?php echo $reppasswordError ?></label>
				<br>
				<input type="password" id="repPass" class="formInput" name="repdesired_pass">
			</div>
		
			<div class = "formLinks">
				<a href="login.php" class="buttonLink"> Already have an account? </a>
			</div>
		
			<div>
				<input type = "submit" class = "formButton" name = "createSubmit" value = "Create"/>
			</div>
		</div>
	</form>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>
	

</html>