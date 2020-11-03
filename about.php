<?php
//About.php

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

        <?php 
        //load in db-configuration file
        include('includes/db-config.php');

        //Create select statments to get data from 2 Databases for use on this page
        $stmt = $pdo->prepare("SELECT * FROM `aboutPageDB` WHERE `aboutPageId` = 1;");

        $stmt -> execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 

            if($_SESSION["userType"] == 'admin'){  
            ?>
            <form action="process-edit-about.php" method="POST" id="editform"> 
                <fieldset>
                    <label for= "aboutPageTitle"> About Page Title:</label>
                    <input type="text" name="aboutPageTitle"  value= "<?php echo($row["aboutPageTitle"]);?>" size="50" required/><br>

                    <label for= "aboutPageDescription">  About Page Paragraph:</label>
                    <textarea  type="text" name="aboutPageDescription" form_Id="editform" rows="15" cols="30"><?php echo($row["aboutPageDescription"]);?> </textarea>

                    <input type="hidden" name="aboutPageId" value= "<?php echo($row["aboutPageId"]);?>">
                    
                </fieldset>
                <input type="submit"  value="Save"/> 
            </form>
            <?php
            } else {
                
            ?>
            <h1> <?php echo($row["aboutPageTitle"]);?></h1>
            <p><?php echo($row["aboutPageDescription"]);?></p> <?php

            }
        }?>


</body>

</html>