<?php
//Delete-article

//startsession 
session_start();


//pass slected article for delete 
$articleId = $_GET["articleId"];

//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//autheticate only admin users to see this page.
if($_SESSION["userType"] == 'admin'){
    
    //delete the article
    $stmt = $pdo->prepare("DELETE FROM `articleDB`
	WHERE `articleId` = $articleId;");

    $stmt->execute();
    

    // Show link to articles-list.php articles dashboard

    ?><h3> Delete Succesful </h3>
    <a href="articles-list.php"> Return to Article Dashboard</a> <?php

    // header("Location: articles-list.php");

} else {
?><h1> Delete is Unsucessful <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to delete articles by </a href= "login.php"> logging in as an admin </a></p> <?php

}



?>