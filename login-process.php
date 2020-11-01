<?php
//login-process.php

//start session 
session_start(); 

//recieve post variables
$username = $_POST["username"];
$password = $_POST["password"];

//check the username and password against the database records

//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');


//Preparing and excecuting the DB statement to check usersDB table for loging in
$stmt = $pdo->prepare("SELECT * FROM `usersDB` WHERE `username` = '$username' AND `password` = '$password' ");

$stmt -> execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row){
    
    //store the authenicated username & usertype row in 2 session variables to be used in other pages.
    $_SESSION["username"] = $row["username"];
    $_SESSION["userType"] = $row["userType"];

    //if successful username/password combination redirect to articles dashboard

    header("Location: articles-list.php");

}else{
    //unsuccesful login error message
    ?><p> Sorry, Incorrect username/password. Please Login OR you might not have an account with us.</p>
    <a href="login.php"> Login here</a> <?php
}
?>