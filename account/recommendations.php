<?php
	include 'account.php';
    
    include_once '../classes/Dao.php';
    $dao = new Dao();
    
    $errorRecommendation = "";
    $username = $_SESSION['login_user'];
    $json = $dao->getUserJSON($username);
    $info = json_decode($json, true);
    $movieTitles = "";
    $count = 0;
    if(isset($info)){
        foreach($info as $key=>$value){    
            if($value > 5){
                $title = "";
                $movieResult = "";
                $omdbJson = "";
                $omdbJson = file_get_contents("http://www.omdbapi.com/?i=" . preg_replace('/\s+/', '_', $key));
                $movieResult = json_decode($omdbJson, true);
                $title = $movieResult['Title'];
                if(explode(' ',trim($title))[0] == "The"){
                    $title = explode(' ',trim($title))[1];
                }else{
                    $title = explode(' ',trim($title))[0];
                }
                $omdbJson2 = file_get_contents("http://www.omdbapi.com/?s=" . preg_replace('/\s+/', '_', $title));
                $omdbInfo = json_decode($omdbJson2, true);
                if(isset($omdbInfo['totalResults']) && $omdbInfo['totalResults'] != 1){
                    $movieIMDB = $omdbInfo['Search'][1]['imdbID'];
                    $omdbJson3 = file_get_contents("http://www.omdbapi.com/?i=" . preg_replace('/\s+/', '_', $movieIMDB));
                    $movieTitles[$count] =  json_decode($omdbJson3, true);
                    $count++;
                }
            }else{
                $errorRecommendation = "Must rate a movie above 5 before site can process recommendations.";
            }
        }
    }
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
				<?php
                foreach($movieTitles as $key=>$val){
                    echo "<tr><th class='postRec'><img src='" . $val['Poster'] . "'/></th>" .
                         "<th class='titleRec'>" . 'Title:' . "<br>" . $val['Title'] . "</th>" .
                         "<th class='imdbRec'>" . 'IMDB Rating:'  . "<br>" . $val['imdbRating'] . "</th>" .
                         "<th class='metaRec'>" . 'Metascore:' . "<br>" .$val['Metascore'] . "</th>" .
                         "<th class='genreRec'>" . 'Genre:' . "<br>" .$val['Genre'] . "</th></tr>";
                }?>
			</tr>
		</table>
	
	
	</div>
	
	<footer class  = "copyrightFoot">
		Patrick Chapman © 2017
	</footer>

</html>