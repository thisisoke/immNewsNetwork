<?php
//process-insert-article.php
//process and insert new articles

//startsession 
session_start();


echo($_POST["articleText"]." ");
echo($_POST["articleTitle"]." ");
echo($_POST["articleCategory"]." ");
echo($_POST["articlePreview"]." ");
echo($_POST["articleLink"]." ");
echo($_POST["articleImage"]." ");
echo($_POST["articleAuthor"]." ");
echo($_POST["articleDate"]." ");


// $articleText = $_POST["articleText"];
// $articleTitle = $_POST["articleTitle"];
// $articleCategory = $_POST["articleCategory"];
// $articlePreview = $_POST["articlePreview"];
// $articleLink = $_POST["articleLink"];
// $articleImage = $_POST["articleImage"];
// $articleAuthor = $_POST["articleAuthor"];
// $articleDate = $_POST["articleDate"];
// $articleLikes = '0';
// $featuredArticleFlag = '0';


//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//autheticate only admin users to see this page.
if($_SESSION["userType"] == 'admin'){
    
    //Insert article in the database
    $stmt = $pdo->prepare("INSERT INTO `articleDB` (`articleId`, `articleText`, `articleTitle`, `articleLikes`, `articleCategory`, `articlePreview`, `articleLink`, `articleImage`, `articleAuthor`, `articleDate`, `featuredArticleFlag`) VALUES ( NULL, '$articleText', '$articleTitle', '$articleLikes', '$articleCategory', '$articlePreview', '$articleLink', '$articleImage', '$articleAuthor', '$articleDate', '$featuredArticleFlag')");

    $stmt -> execute();

    ?><h1> Insert Article Succesful <?php echo($_SESSION["username"]) ?> </h1>
<p> Click to go back to<a href= "articles-list.php"> Article Dashboard </a></p> <?php
    
} else {

?><h1> You are not Authorized to Insert Articles <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to insert articles by <a href= "login.php"> logging in as an admin </a></p> <?php

}



?>