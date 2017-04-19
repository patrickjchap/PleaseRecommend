<?php
	include_once 'account.php';
    include_once '../classes/Dao.php';
    $dao = new Dao();
    
    $username = $_SESSION['login_user'];
     
    $currentRating = "#";
    $firstResult = "";
    $movieID = "";
    $movieTitle = "";
    $IMDBRating = "";
    $movieDescription = "";
    $imgURL = "";
    $errorRating = "";
    
    if(isset($_SESSION['first_result'])){
        $firstResult = $_SESSION['first_result'];
        $movieID = $firstResult['imdbID'];
        $movieTitle = $firstResult['Title'];
        $IMDBRating = $firstResult['imdbRating'];
        $movieDescription = $firstResult['Plot'];
        $imgURL = $firstResult['Poster'];
    }
    
    if($firstResult != ""){   
            $json = $dao->getUserJson($username);
            $info = json_decode($json, true);
            if(isset($info[$firstResult['imdbID']])){
                $currentRating = $info[$firstResult['imdbID']];
            }
    }
       
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['searchText'])) {
        
        
        $searchTitle = htmlspecialchars($_POST['searchText']);
        $omdbJson = file_get_contents("http://www.omdbapi.com/?s=" . preg_replace('/\s+/', '_', $searchTitle));
        $omdbInfo = json_decode($omdbJson, true);
        $currentRating = "#";

        if(isset($omdbInfo['Search'])){
            $firstPage = $omdbInfo['Search'][0];
            $omdbJson2 = file_get_contents("http://www.omdbapi.com/?i=" . preg_replace('/\s+/', '_', $firstPage['imdbID']));
            $firstResult = json_decode($omdbJson2, true);
            
            $_SESSION['first_result'] = $firstResult;
            $movieTitle = $firstResult['Title'];
            $movieID = $firstResult['imdbID'];
            $IMDBRating = $firstResult['imdbRating'];
            $movieDescription = $firstResult['Plot'];
            $imgURL = $firstResult['Poster'];
        }
        
        if($firstResult != ""){   
            $json = $dao->getUserJson($username);
            $info = json_decode($json, true);
            if(isset($info[$firstResult['Title']])){
                $currentRating = $info[$firstResult['Title']];
            }
        }
    }
    
    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['userSubmitRating'])){
        if($firstResult != "" && $_GET['userSubmitRating'] <= 10 && $_GET['userSubmitRating'] >= 1){
            $json = $dao->getUserJson($username);
            $info = json_decode($json, true);
            if(isset($info[$firstResult['imdbID']])){
                $info[$firstResult['imdbID']] = $_GET['userSubmitRating'];
                $currentRating = $_GET['userSubmitRating'];
                $arg = json_encode($info);
                $dao->setUserRating($username, $arg);
                
            }else{
                $info[$firstResult['imdbID']] = $_GET['userSubmitRating'];
                $currentRating = $_GET['userSubmitRating'];
                $arg = json_encode($info);
                $dao->setUserRating($username, $arg);
            }
        }else if($_GET['userSubmitRating'] > 10 || $_GET['userSubmitRating'] < 1){
            $errorRating = "Please enter valid rating (1-10).";
        }
    }

    
?>

<html>

	<head>
		<link rel="stylesheet" href="account.css">
		<link href="https://fonts.googleapis.com/css?family=Baloo" rel="stylesheet">
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script type="text/javascript" src="search.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
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
			<form action = "" method = "post" id="searchForm">
                <div class="topText">Search <input type="text" id="searchBox" name="searchText"/>
                    <input type="submit" class="searchButton" id="autocomplete" value="go"/>
                </div>
            </form>
	</header>
	
	<div class="middleSection">
		<div>
			<img id="moviePicSearch" src="<?php echo $imgURL ?>"/>
		</div>
	
		<div id="movieInfo">
			Name: <?php echo $movieTitle ?>
            <br>
            <div class="textError"> <?php echo $errorRating ?> </div>
			<label for="ratingBox">Your Rating: <?php echo $currentRating ?></label>
                <form action = "" method = "GET" id="ratingForm">
                    <input type="text" name="userSubmitRating" id="userRatingText" placeholder=
                    <?php
                        echo '"' . $currentRating . '"';
                    ?>>
                </form>
			IMDB RATING: <?php echo $IMDBRating ?>
			<br>
			DESCRIPTION: <?php echo $movieDescription ?>
		</div>
	</div>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>