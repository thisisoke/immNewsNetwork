<?php
//insert-contact.php

//start session 
//session_start(); 

//recieve post variables
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$role = $_POST["role"];

//Normalizing checkbox entry to either 0 or 1 to match boolean in database. recieving category variables 

if (empty($_POST["categoryInterest1"])){
    $categoryInterest1 = "0";
} else {
    $categoryInterest1 = $_POST["categoryInterest1"];
}

if (empty($_POST["categoryInterest2"])){
    $categoryInterest2 = "0";
} else {
    $categoryInterest2 = $_POST["categoryInterest1"];
}

if (empty($_POST["categoryInterest2"])){
    $categoryInterest3 = "0";
} else {
    $categoryInterest3 = $_POST["categoryInterest1"];
}




//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//Preparing and excecuting the DB statement to check usersDB table for loging in
$stmt = $pdo->prepare("INSERT INTO `contactDB`(`contactId`, `firstname`, `lastname`, `email`, `categoryIndustry`, `categoryTechnical`, `categoryCareer`, `role`) VALUES (NULL,'$firstname', '$lastname', '$email',  '$categoryInterest1',  '$categoryInterest2',  '$categoryInterest3', '$role');");


$stmt -> execute();



?><h1> Contact Sumission Succesful <?php echo($_SESSION["username"]) ?> </h1>
<p> Click to go back to<a href= "articles-list.php"> Article Dashboard </a></p> <?php

?>