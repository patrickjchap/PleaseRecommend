<?php
include_once 'account.php';
include_once '../classes/Dao.php';

$dao = new Dao();
    
$username = $_SESSION['login_user'];
     


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