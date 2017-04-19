<?php
	include_once 'account.php';
    $dao = new Dao();
    
    $username = $_SESSION['login_user'];
    $name = $dao->getUserFName($username);
    $email = $dao->getUserEmail($username);
    
    
    
?>

<html>
	
	<head>
		<link rel="stylesheet" href="account.css">
		<link href="https://fonts.googleapis.com/css?family=Baloo|Bitter" rel="stylesheet">
	</head>
	
	<div class = "logo">
			<a href = "../index.php"><img src = "../PRLogo.png" class="imgLogo"></a>  
	</div>

	<div class="navigation">
		
		<a href="myaccount.php" class="tabLink" id="myacct"> <div class="accountTab" id="activeTab" for = "myacct">My Account</div></a>

		<a href="mymovies.php" class="tabLink" id="mymov"> <div class="accountTab" for="mymov">My Movies</div> </a>

		<a href="recommendations.php" class="tabLink" id="acctTab"><div class="accountTab" for="acctTab"> Recommendations</div> </a>

		<a href="search.php" class="tabLink" id="search"> <div class="accountTab"for="search">Search Movies</div> </a>

	</div>
	
	<header class = "accountTopBanner">
		<div class="topText">Account Information</div>
	</header>
	
	<div class="middleSection">
	
		<div class="userInfo">
			<?php echo 'Name: ' . htmlspecialchars($name )?>
		</div>
	
		<div class="userInfo">
			<?php echo 'Email: ' . htmlspecialchars($email) ?>
		</div>
	
		<div class="userInfo">
			<?php echo 'Username: ' . htmlspecialchars($myusername) ?>
		</div>
	
		<div class="linkButton">
			<a href="../form/changepassword.html"> Change Password </a>
		</div>
		
		<form action = "" method = "post">
			<input type = "submit" class="logoutButton" name = "logout" value="Log Out"/>
		</form>
	</div>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>
	
</html>