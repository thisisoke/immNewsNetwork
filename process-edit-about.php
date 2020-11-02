<?php
//process-edit-about.php
//process and updated edited about page


//startsession 
session_start();


//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

$aboutPageTitle = $_POST["aboutPageTitle"];
$aboutPageDescription = $_POST["aboutPageDescription"];



//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//autheticate only admin users to see this page.
if($_SESSION["userType"] == 'admin'){

    //Insert article in the database
    $stmt = $pdo->prepare("UPDATE `aboutPageDB` SET `aboutPageTitle`= $aboutPageTitle,`aboutPageDescription`= $aboutPageDescription WHERE `articleId` = $aboutPageId;");


    $stmt -> execute();

    header("Location: about.php");
    
} else {

?><h1> You are not Authorized to Edit the About Page <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to edit pages by <a href= "login.php"> logging in as an admin </a></p> <?php

}



?>