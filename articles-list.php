<?php
//articles-list.php
//Home Page/Article Dashbaord of IMM News network

//start PHP Session 
session_start();
?>

<!-- Show HTML on pgae that is applicable to public/un-authenticated users  -->
<!-- Hide HTML portions of the page based on authentication and userType using integrated php -->
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
    <div id="navigation">
        <img src="assets/imm-logo-black.png" alt="IMM News Network" width="100">
        <ul>
            <li><a href="articles-list.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            //Show the login or logout item conditional based on if current user has a authenticated session or not

            if (isset($_SESSION["username"])) {
            ?>
                <li>
                    <a href="logout.php">Log Out: <?php echo ($_SESSION["username"]) ?></a>

                </li><?php
                    } else {
                        ?><li><a href="login.php">Log In</a></li><?php
                                                                }
                                                                    ?>
            <!-- Show insert article link for admin users -->
            <?php
            if ($_SESSION["userType"] == 'admin') {
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

    <h1>Welcome <?php echo ($_SESSION["username"]) ?> to the IMM News Network</h1>
    <p> Welcome Paragraph: to the most trusted name in news </p>


    <?php
    //load in db-configuration file
    include('includes/db-config.php');

    //Create select statments to get data from 2 Databases for use on this page
    $stmt = $pdo->prepare("SELECT * FROM `articleDB` WHERE `featuredArticleFlag` = '1' ");

    $stmt1 = $pdo->prepare("SELECT * FROM `articleDB` WHERE `articleCategory` = 'career' ");

    $stmt2 = $pdo->prepare("SELECT * FROM `articleDB` WHERE `articleCategory` = 'technical' ");
    $stmt3 = $pdo->prepare("SELECT * FROM `articleDB` WHERE `articleCategory` = 'industry' ");

    $stmt4 = $pdo->prepare("SELECT * FROM `visitorDataDB`");

    $stmt->execute();
    $stmt1->execute();
    $stmt2->execute();
    $stmt3->execute();

    $stmt4->execute();


    
    //cycle through each row in the DB to display article list and buttons based on PHP Session Authentication/un-authentication

    //Featured Article: 
    ?> <h1> Featured Article: </h1>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        //Display Featured Article if the article row entry has a TRUE set in the featuredArticleFlag column
        if ($row["featuredArticleFlag"] == 1) {

            //load in article display component
            include('includes/article-display-component.php');
        }    
        
    };
    

    //Industry Articles: 
    ?> 
    <hr>
    <h1> Industry Articles: </h1>
    <?php
    while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {

         //Display industry category
        if ($row["articleCategory"] == "industry" && $row["featuredArticleFlag"] == 0) {
    
            //load in article display component
            include('includes/article-display-component.php');
            
        };  
        
    };

    //Technical Article: 
    ?> 
    <hr>
    <h1> Technical Articles: </h1>
    <?php
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {

        //Display of technical category
        if ($row["articleCategory"] == 'technical' && $row["featuredArticleFlag"] == 0) {

    
            //load in article display component
            include('includes/article-display-component.php');
        } ; 
        
    };

    //Career Article: 
    ?> 
    <hr>
    <h1> Career Articles: </h1>
    <?php
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {

        //Display of career category
        if ($row["articleCategory"] == 'career' && $row["featuredArticleFlag"] == 0) {

    
            //load in article display component
            include('includes/article-display-component.php');
        };  
        
    };
    

    

    ?>


    <!-- MAKE SURE EACH CATEGORY HAS 2 article entries -->

    <hr>

    <!-- Table Data  -->
    <table>
        <tr>
            <th> Month
            <th>
            <th> Number of Visitors
            <th>
        </tr>
        <!-- Pull every row of Month/visitor data and add is as a table row in HTML -->
        <?php
        while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
        ?><tr>
                <td><?php echo ($row["monthName"]); ?>
                <td>
                <td> <?php echo ($row["visitorNumber"]); ?>
                <td>
            </tr><?php
                } ?>
    </table>


    <!-- youtube video emebed -->
    <div>
        <h2> Video of the Day </h2>
        <iframe width="879" height="494" src="https://www.youtube.com/embed/lTRiuFIWV54" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

    <!-- Footer -->
    <footer>
        <p>Please Accept cookies for best usage of our website:</p>
        <p><a href="#">Accept Cookies</a></p>
    </footer>

</body>

</html>