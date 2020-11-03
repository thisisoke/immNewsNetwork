<?php
//process-edit-article.php
//process and updated edited articles


//startsession 
session_start();


$articleId = $_POST["articleId"];
$articleText = $_POST["articleText"];
$articleTitle = $_POST["articleTitle"];
$articleCategory = $_POST["articleCategory"];
$articlePreview = $_POST["articlePreview"];
$articleLink = $_POST["articleLink"];
$articleImage = $_POST["articleImage"];
$articleAuthor = $_POST["articleAuthor"];
$articleDate = $_POST["articleDate"];
$articleLikes = '0';
$featuredArticleFlag = '0';


//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//autheticate only admin users to see this page.
if($_SESSION["userType"] == 'admin'){

    //Insert article in the database
    $stmt = $pdo->prepare("UPDATE `articleDB` SET `articleText`= '$articleText',`articleTitle`= '$articleTitle',`articleCategory`= '$articleCategory',`articlePreview`= '$articlePreview',`articleLink`= '$articleLink',`articleImage`= '$articleImage',`articleAuthor`= '$articleAuthor',`articleDate`= '$articleDate' WHERE `articleId` = '$articleId' ");


    $stmt -> execute();

    ?><h1> You have Edited The <br> <?php echo($articleTitle) ?><br>Article Succesfully  <?php echo($_SESSION["username"]) ?> </h1>
<p> Click to go back to<a href= "articles-list.php"> Article Dashboard </a></p> <?php
    
} else {

?><h1> You are not Authorized to Edit <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to edit articles by <a href= "login.php"> logging in as an admin </a></p> <?php

}



?>