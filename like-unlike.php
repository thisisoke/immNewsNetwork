<?php
//like-unlike.php
//Like or unlike an article
//startsession 
session_start(); 

//pull selected article and join with article liked DB and personid filtered

$username = $_SESSION["username"];
$articleId = $_GET["articleId"];
$returnId = $_GET["returnId"];
$finalLikes = 0 ;

//load in db-configuration file
include('includes/db-config.php');

//Select all liked entries in likesDB for the selected articleID

$stmt = $pdo->prepare("SELECT * FROM `likesDB` WHERE `articleId` = '$articleId' AND `username` = '$username' ");

$stmt -> execute();

$likedAlready = $stmt->fetch(PDO::FETCH_ASSOC);

//if article is already liked, Unlike it. If its not liked, then like it

if($likedAlready["articleId"] == NULL && $likedAlready["username"] == NULL ){

    $stmt2 = $pdo->prepare("INSERT INTO `likesDB`(`id`, `articleId`, `username`) VALUES (NULL,'$articleId', '$username');");

    $stmt2 -> execute();

} else {

    $stmt1 = $pdo->prepare("DELETE FROM `likesDB` WHERE `articleId` = $articleId AND `username` = '$username'"); 

    $stmt1 -> execute();
   

}



//Count and SUM the likes in the likesDB and add it to likes in articleDB then update the article DB

//Count the likes in the likesDB 
$stmt3 = $pdo->prepare("SELECT COUNT(articleId) FROM `likesDB` WHERE `articleId` =  '$articleId' ");
$stmt3 -> execute();

//Store counted number in countLikesDB
$countlikesDB = $stmt3->fetch(PDO::FETCH_ASSOC);

echo($countlikesDB["COUNT(articleId)"]);

$counted = $countlikesDB["COUNT(articleId)"];

//Update the articleDB with new amount 
 $stmt4 = $pdo->prepare("UPDATE `articleDB` SET `articleLikes`= '$counted' WHERE `articleId` = '$articleId' ");
 $stmt4->execute();

 
//redirect back to to article dashboard
header("Location: articles-list.php");

?>