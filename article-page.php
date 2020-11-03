<?php
//article-page.php
//make a single dynamic article page that can be used to render any article that has been clicked . article id is pased in the post and the content is rendered.

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

<?php
//load in db-configuration file
include('includes/db-config.php');

$articleId = $_GET["articleId"];

//Create select statments to get data from 2 Databases for use on this page
$stmt = $pdo->prepare("SELECT * FROM `articleDB` WHERE `articleId` = '$articleId' ");

$stmt -> execute();
//store the artcle row in variable
$displayArticle = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<h2> <?php echo ($displayArticle["articleTitle"]); ?></h2> 
<h4> <?php echo ($displayArticle["articlePreview"]); ?></h4>
<p> Author: <?php echo ($displayArticle["articleAuthor"]); ?> </p>
<p> <a href="<?php echo ($displayArticle["articleLink"]); ?>">  Orginal Article Link</a></p>
<p> Category: <?php echo ($displayArticle["articleCategory"]); ?> </p>
<p>Likes: <?php echo ($displayArticle["articleLikes"]); ?> </p>

<!-- //Article Image and Text body -->
<br><img src="<?php echo ($displayArticle["articleImage"]); ?>" alt="News Article" width="500"> <br> 
<p> <?php echo ($displayArticle["articleText"]); ?> </p>



</body>

</html>