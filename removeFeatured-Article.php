<?php
//removeFeatured-Atricle.php
//removing article from featured

//startsession 
session_start();

//pass slected article for feature flag on 
$articleId = $_GET["articleId"];

//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//Check if User is Admin
if($_SESSION["userType"] == 'admin'){ 

    //Find the desired article to set to remove featured in the database
    $stmt2 = $pdo->prepare("UPDATE `articleDB` SET `featuredArticleFlag`= '0' WHERE `articleId` = $articleId;");
    $stmt2->execute();

    //Get article Name for success message
    $stmt3 = $pdo->prepare("SELECT * FROM `articleDB` WHERE `articleId` = $articleId;");
    $stmt3 -> execute();

    while($row = $stmt3->fetch(PDO::FETCH_ASSOC)) { 

    ?><h1> You Have Succesfully Removed  <i><?php echo($row["articleTitle"]);?></i> as a featured article <?php echo($_SESSION["username"]) ?> </h1>
    <p> Navigate back to the <a href= "articles-list.php"> Article Dashboard</a></p> <?php
    }

} else {

    ?><h1> You are not Authorized to set the Feature Flag on an article <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to edit pages by <a href= "login.php"> logging in as an admin </a></p> <?php
}


?>