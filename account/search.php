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

		<a href="recommendations.php" class="tabLink" id="acctTab"><div class="accountTab" for="acctTab"> Recommendations</div> </a>

		<a href="search.php" class="tabLink" id="search"> <div class="accountTab"  id="activeTab" for="search">Search Movies</div> </a>
	</div>
	
	<header class = "accountTopBanner">
			<div class="topText">Search <input type="text" id="searchBox"><a href = "search.html" id = "searchButton">go</a></div>
	</header>
	
	<div class="middleSection">
		<div id="moviePicSearch">
			PICTURE OF MOVIE
		</div>
	
		<div id="movieInfo">
			Name:
			<br>
			Your Rating ../10
			<br>
			IMDB RATING:
			<br>
			METASCORE:
			<br>
			DESCRIPTION:
		</div>
	</div>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>