<?php
//contact-List.php
//display contact list on this page


//start PHP Session 
session_start();
?>

<!doctype html>
<html>
<head>
<!-- Meta Data, please visit -->
        <meta charset="utf-8">
        <title>IMM News Metwork</title>
        <meta content="IMM News network aggregate of design news" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="keywords" content="industry, news, career, imm" />
	    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	    <link rel="manifest" href="/site.webmanifest">
	    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	    <meta name="msapplication-TileColor" content="#da532c">
	    <meta name="theme-color" content="#ffffff">
</head>
<body>

<!-- Navgigation div of the article dashboard -->
<div id= "navigation">
<img src="assets/imm-logo-black.png" alt="IMM News Network" width="100" > 
<ul>
  <li><a href="articles-list.php">Home</a></li>
  <li><a href="about.php">About</a></li>
  <li><a href="contact.php">Contact</a></li>
  <?php
  //Show the login or logout item conditional based on if current user has a authenticated session or not

    if(isset($_SESSION["username"])){
        ?>
        <li>
            <a href="logout.php">Log Out: <?php echo($_SESSION["username"]) ?></a>
            
        </li><?php
    } else {
        ?><li><a href="login.php">Log In</a></li><?php
    }
  ?>
<!-- Show insert article link for admin users -->
<?php 
    if($_SESSION["userType"] == 'admin'){  
    ?>
        <li>
            <a href="insert-article.php">Insert Article</a>   
        </li>
        <li>
            <a href="contact-list.php"> View Contact List Results</a>   
        </li>
        <?php
    }
?>
  
</ul>
</div>

<h1>Welcome<?php echo($_SESSION["username"]) ?> to the Contact List</h1>
<p> You can view all the people who signed up for contact on the IMM News network</p>

<?php


//load in db-configuration file
include('includes/db-config.php');

//Create select statments to get data from 2 Databases for use on this page
$stmt = $pdo->prepare("SELECT * FROM `contactDB`");

$stmt -> execute();

//cycle through each row in the DB to display contact list from the DB in a html table:


?>

    <!-- Contact Table Data  -->
<table>
    <tr>
        <th> First Name <th>
        <th> Last Name <th>
        <th> email <th>
        <th> Industry News <th>
        <th> Technical News <th>
        <th> Career News <th>
        <th> Role <th>
    </tr>
    <!-- Pull every row of contact data and add is as a table row in HTML -->
    <?php
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
        ?><tr>
            <td><?php echo($row["firstname"]);?> <td>
            <td> <?php echo($row["lastname"]);?> <td>
            <td><?php echo($row["email"]);?> <td>
            <td> <?php echo($row["categoryIndustry"]);?> <td>
            <td> <?php echo($row["categoryTechnical"]);?> <td>
            <td> <?php echo($row["categoryCareer"]);?> <td>
            <td> <?php echo($row["role"]);?> <td>
        </tr><?php
    }?>
</table>