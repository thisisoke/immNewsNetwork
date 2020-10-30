<?php
//articles-list.php
//Home Page of IMM News network
?>

<!doctype html>
<html>
<head>

    <meta charset="utf-8">
    <title>IMM News Metwork</title>
    <meta content="IMM News network aggregate of design news" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="assets/favicon.png" rel="shortcut icon" type="image/x-icon">
  <link href="assets/imm-logo-black.png" rel="apple-touch-icon">

</head>
<body>

<div id= "navigation">
<img src="assets/imm-logo-big.png" alt="IMM News Network" width="100" height="49"> 
<ul>
  <li><a href="articles-list.php">Home</a></li>
  <li><a href="about.html">About</a></li>
  <li><a href="contact.html">Contact</a></li>
</ul>
</div>

<h1>Welcome to the IMM News Network</h1>
<p> Welcome to the most trusted name in news </p>
<!-- inset article list based on PHP Session Authentication -->

<?php
//load in db-configuration file
include('includes/db-config.php');

$stmt = $pdo->prepare("SELECT * FROM `articleDB`");

$stmt -> execute();

//cycle through each row in the DB
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {     
    
    //Display Featured Article if the article row entry has a TRUE set in the featuredArticleFlag column
    if ($row["featuredArticleFlag"] == 1){
        ?>

    <h2> Featured Articles: <h2>  
    <img src="assets/<?php echo($row["articleImage"]);?>" alt="News Article" width="300" >
    
    <!-- Featured Articles -->
    <h2> <?php echo($row["articleTitle"]);?></h2>
    <h4> <?php echo($row["articlePreview"]);?></h4>
    <p> Author: <?php echo($row["articleAuthor"]);?> </p>
    <p> <a href="<?php echo($row["articleLink"]);?>">Read Full Article Link</a></p>
    <p> Category: <?php echo($row["articleCategory"]);?> </p>
    <?php

    } 

    if ($row["featuredArticleFlag"] == 0){
        ?>
        <h2> List of Articles : <h2>
    <img src="assets/<?php echo($row["articleImage"]);?>" alt="News Article" width="100" >
    
    <!-- Article Titles -->
    <h2> <?php echo($row["articleTitle"]);?></h2>
    <h4> <?php echo($row["articlePreview"]);?></h4>
    <p> Author: <?php echo($row["articleAuthor"]);?> </p>
    <p> <a href="<?php echo($row["articleLink"]);?>">Read Full Article Link</a></p>
    <p> Category: <?php echo($row["articleCategory"]);?> </p>
    <?php
    }
}

?>


<!-- MAKE SURE EACH CATEGORY HAS 2 article entries -->


Table Data 
<!-- <table>
    <col>Month</col>
    <row1> Jan</row> 
    <col>Number of Visitors</col>
    <row1> 200</row> 

</table> -->

Embeded Video

<!-- youtube video emebed -->




<footer>
  <p>Please Accept cookies for best usage of our website:</p>
  <p><a href= "#" >Accept Cookies</a></p>
</footer>

</body>
</html>

