<?php
	include 'account.php';
    include_once '../classes/Dao.php';
    $dao = new Dao();
    
    $username = $_SESSION['login_user'];
    $json = $dao->getUserJSON($username);
    $info = json_decode($json, true);
    
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

		<a href="mymovies.php" class="tabLink" id="mymov"> <div class="accountTab"  id="activeTab" for="mymov">My Movies</div> </a>

		<a href="recommendations.php" class="tabLink" id="acctTab"><div class="accountTab" for="acctTab"> Recommendations</div> </a>

		<a href="search.php" class="tabLink" id="search"> <div class="accountTab"for="search">Search Movies</div> </a>
	</div>

	<header class = "accountTopBanner">
		<div class="topText">My Movies</div>
	</header>	

	<div class="middleSection">
        <table id="labelTable">
            <tr><th class="picCol">Poster</th><th class="titleCol">Title & Description</th><th class="ratCol">User Rating</th></tr>
        </table>
		<table class="tableContent">
			<?php
                if(isset($info)){
                    foreach($info as $key => $value){
                    
                        $omdbJson = file_get_contents("http://www.omdbapi.com/?i=" . preg_replace('/\s+/', '_', $key));
                        $movieResult = json_decode($omdbJson, true);
                        $title = $movieResult['Title'];
                        $imgURL = $movieResult['Poster'];
                        $desc = $movieResult['Plot'];
                    
                        echo "<tr><th class='picCol'><img src='" . $imgURL . "'/></th>" .    "<th class='titleCol'>" . $title . "<br> <br>" . $desc . "</th>" . "<th class='ratCol'>" . $value . "</th></tr>";
                 
                    }
                }else{
                        echo "NO MOVIES FOR USER. PLEASE ADD MOVIES BY SEARCHING.";
                }
            ?>
		</table>
	</div>
	
	<footer class  = "copyrightFoot">
			Patrick Chapman © 2017
	</footer>
	

</html>