<?php
	include 'account.php';
?>

<html>
	
	<head>
		<link rel="stylesheet" href="account.css">
		<link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">
	</head>
	
	<div class = "logo">
			<a href = "../index.php"><img src = "../PRLogo.png" class="imgLogo"></a> 
	</div>
	
	<div class="navigation">
		<a href="myaccount.php" class="tabLink" id="myacct"> <div class="accountTab" for = "myacct">My Account</div></a>

		<a href="mymovies.php" class="tabLink" id="mymov"> <div class="accountTab" for="mymov">My Movies</div> </a>

		<a href="recommendations.php" class="tabLink" id="acctTab"><div class="accountTab"  id="activeTab" for="acctTab"> Recommendations</div> </a>

		<a href="search.php" class="tabLink" id="search"> <div class="accountTab"for="search">Search Movies</div> </a>
	</div>
	
	<header class = "accountTopBanner">
			<div class="topText">Movie Recommendations</div>
	</header>
	
	<div class="middleSection">	
	
		<table class="tableContent">
			<tr>
				<th>Name</th>
				<th>IMDB Rating</th>
				<th>Metascore</th>
				<th>Genre</th>
			</tr>
		
			<tr>
				<th>Example</th>
				<th>0/10</th>
				<th>10/10</th>
				<th>Horror</th>
			</tr>
		</table>
	
	
	</div>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>