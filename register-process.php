<?php
//register-process.php

//register a non-admin user and redirect them to article dashboard  

//start session 
session_start(); 

//recieve post variables and assigned thhem to the registration variables to be inserted into Data base
$usernameReg = $_POST["username"];
$passwordReg = $_POST["password"];
$emailReg = $_POST["email"];

//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//Preparing and excecuting the DB statement to insert new users into usersDB table
$stmt = $pdo->prepare("INSERT INTO `usersDB`(`userId`, `username`, `password`, `userType`, `email`) VALUES (NULL,'$usernameReg', '$passwordReg', 'registered', '$emailReg');");

$stmt -> execute();


//assigned username and usertype to session variables for access in the articles-listphp
$_SESSION["username"] = $_POST["username"];
$_SESSION["userType"] = 'registered';


header("Location: articles-list.php");
?>