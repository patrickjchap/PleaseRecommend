<?php
	include_once 'account.php';
    include_once '../classes/Dao.php';
    $dao = new Dao();
    
    $username = $_SESSION['login_user'];
     
    $currentRating = "#";
    $firstResult = "";
    $movieTitle = "";
    $IMDBRating = "";
    $movieDescription = "";
    $imgURL = "";
    
    if(isset($_SESSION['first_result'])){
        $firstResult = $_SESSION['first_result'];
        $movieTitle = $firstResult['Title'];
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
       
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['searchText'])) {
        
        
        $searchTitle = htmlspecialchars($_POST['searchText']);
        $omdbJson = file_get_contents("http://www.omdbapi.com/?s=" . preg_replace('/\s+/', '_', $searchTitle));
        $omdbInfo = json_decode($omdbJson, true);

        if(isset($omdbInfo['Search'])){
            $firstPage = $omdbInfo['Search'][0];
            $omdbJson2 = file_get_contents("http://www.omdbapi.com/?i=" . preg_replace('/\s+/', '_', $firstPage['imdbID']));
            $firstResult = json_decode($omdbJson2, true);
            
            $_SESSION['first_result'] = $firstResult;
            $movieTitle = $firstResult['Title'];
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
        if($firstResult != "" && preg_match("/10|[1-9]/", $_GET['userSubmitRating'])){
            $json = $dao->getUserJson($username);
            $info = json_decode($json, true);
            if(isset($info[$firstResult['Title']])){
                $info[$firstResult['Title']] = $_GET['userSubmitRating'];
                $currentRating = $_GET['userSubmitRating'];
                $arg = json_encode($info);
                $dao->setUserRating($username, $arg);
                
            }else{
                $info[$firstResult['Title']] = $_GET['userSubmitRating'];
                $currentRating = $_GET['userSubmitRating'];
                $arg = json_encode($info);
                $dao->setUserRating($username, $arg);
            }
        }
    }   

    
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
			<form action = "" method = "post">
                <div class="topText">Search <input type="text" id="searchBox" name="searchText"/>
                    <input type="submit" class="searchButton" value="go"/>
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
			Your Rating: <?php echo $currentRating ?> <form action = "" method = "GET">
                        <input type="text" name="userSubmitRating" id="userRatingText" placeholder=
                         <?php
                            echo '"' . $currentRating . '"';
                         ?>>
                         </form>
                         
                         
			<br>
			IMDB RATING: <?php echo $IMDBRating ?>
			<br>
			DESCRIPTION: <?php echo $movieDescription ?>
		</div>
	</div>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>