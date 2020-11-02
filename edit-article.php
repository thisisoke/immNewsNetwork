<?php
//Edit-article landing

//startsession 
session_start();


//pass slected article for delete 
$articleId = $_GET["articleId"];

//dsn connection to data base by inlcuding db config file with connection details.
include('includes/db-config.php');

//autheticate only admin users to see this page.
if($_SESSION["userType"] == 'admin'){
    
    //Find the article in the database
    $stmt = $pdo->prepare("SELECT * FROM `articleDB` WHERE `articleId` = $articleId;");

    $stmt->execute();

    //store row in the vairable 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    

    ?><!DOCTYE html>
    <html>
        <head>
            <meta charset="utf-8"/>
        </head>
    <body>

    <form action="process-edit-article.php" method="POST" id="editform"> 
        
        <fieldset>
            <label for= "articleTitle"> Article Title:</label>
            <input type="text" name="articleTitle"  value= "<?php echo($row["articleTitle"]);?>" size="100" required/><br>
            
            <label for= "articlePreview"> Article Preview:</label>
            <input type="text" name="articlePreview" value= "<?php echo($row["articlePreview"]);?>" size="100"required /><br>


            <!-- articleCategory dropdown -->
        <label for="articleCategory">Article Category:</label>
            <select name="articleCategory">
                <option value="<?php echo($row["articleCategory"]);?>" selected ><?php echo($row["articleCategory"]);?></option>
                <option value="industry">industry</option>
                <option value="technical" selected>technical</option>
                <option value="career" selected>career</option>
            </select><br>
            
            <label for= "articleAuthor"> Article Author:</label>
            <input type="text" name="articleAuthor"  value= "<?php echo($row["articleAuthor"]);?>" size="40"required /><br>

            <label for= "articleLink"> Article Link:</label>
            <input type="text" name="articleLink"  value= "<?php echo($row["articleLink"]);?>" size="100"required /><br>

            <label for="articleDate">Article Date:</label>
            <input type="text" name="articleDate" value= "<?php echo($row["articleDate"]);?>" required/><br>

            <label for="articleImage">Link an image for the article:</label>
            <input type="text" name="articleImage" value= "<?php echo($row["articleImage"]);?>"required /><br>

            <input type="hidden" name="articleId" value="<?php echo($row["articleId"]);?>">

            <label for= "articleText"> Article Text:</label>
             <textarea  type="text" name="articleText" form_Id="editform" rows="40" cols="50"><?php echo($row["articleText"]);?> </textarea>

        </fieldset>
        <input type="submit" />  
    </form>

    </body>
    </html> <?php
    
} else {

?><h1> You are not Authorized to Edit <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to delete articles by <a href= "login.php"> logging in as an admin </a></p> <?php

}



?>