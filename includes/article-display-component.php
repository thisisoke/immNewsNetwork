<?php
//Article Display Component

if ($row["featuredArticleFlag"] == 1) {

    $featuredImageSize = '300';
} else {
    $featuredImageSize = '100';
};

if ($_SESSION["userType"] == 'admin') {
?>
    <!-- Like article Button  -->
    <!-- Set featured Button -->

    <a href="like-unlike.php?articleId=<?php echo ($row["articleId"]); ?>"> <?php echo ($row["articleLikes"]); ?> Likes |</a> <br>

    <?php if ($row["featuredArticleFlag"] == 1) {

    ?>
        <a href="removeFeatured-Article.php?articleId=<?php echo ($row["articleId"]); ?>"> Un-Feature This Article</a><br>
    <?php
    } else {
    ?>
        <a href="setFeatured-Article.php?articleId=<?php echo ($row["articleId"]); ?>"> Feature This Article</a><br>
    <?php

    };
} elseif ($_SESSION["userType"] == 'registered') {
    ?>
    <!-- Like article Button  -->
    <a href="like-unlike.php?articleId=<?php echo ($row["articleId"]); ?>"> <?php echo ($row["articleLikes"]); ?> Likes |</a><br>
    <?php
} else {
    ?> <p><a href="login.php">Log In </a> to Like this Article </p>
    <?php
}

//Display Article details
?>
<img src="<?php echo ($row["articleImage"]); ?>" alt="News Article" width="<?php echo ($featuredImageSize) ?>">


<h2> <?php echo ($row["articleTitle"]); ?></h2>
<h4> <?php echo ($row["articlePreview"]); ?></h4>
<p> Author: <?php echo ($row["articleAuthor"]); ?> </p>
<p> <a href="article-page.php?articleId=<?php echo ($row["articleId"]); ?>">Read Full Article |</a><a href="<?php echo ($row["articleLink"]); ?>">  Orginal Article Link</a></p>
<p> Category: <?php echo ($row["articleCategory"]); ?> </p>

<!-- AUTHENTICATE ONLY ADMIN users to see the following. using if{}. Also authenticate admin users on each page aswell -->
<!-- Edit Button & Delete Button & Set Featured  -->
<?php
if ($_SESSION["userType"] == 'admin') {
?>

    <!-- edit and delete article button -->
    <p><a href="edit-article.php?articleId=<?php echo ($row["articleId"]); ?>">Edit | </a><a href="delete-article.php?articleId=<?php echo ($row["articleId"]); ?>"> Delete | </a>

    </p>
    <br>
    <br>



<?php
} else {
?> <br>
    <br> <?php
        }


            ?>