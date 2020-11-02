<?php
//insert-article landing

//startsession 
session_start();


//autheticate only admin users to see this page.
if($_SESSION["userType"] == 'admin'){

    ?><!DOCTYE html>
    <html>
        <head>
            <meta charset="utf-8"/>
        </head>
    <body>

    <h1> Insert A New Article </h1>
    <p> Complete the following form to create a new article in the IMM News network</p>

    <form action="process-insert-article.php" method="POST" id="editform"> 
        
        <fieldset>
            <label for= "articleTitle"> Article Title:</label>
            <input type="text" name="articleTitle" size="100" required /><br>
            
            <label for= "articlePreview"> Article Preview:</label>
            <input type="text" name="articlePreview" size="100" required /><br>


            <!-- articleCategory dropdown -->
        <label for="articleCategory">Article Category:</label>
            <select name="articleCategory">
                <option value="industry">industry</option>
                <option value="technical" selected>technical</option>
                <option value="career" selected>career</option>
            </select><br>
            
            <label for= "articleAuthor"> Article Author:</label>
            <input type="text" name="articleAuthor" size="40" required /><br>

            <label for= "articleLink"> Article Link:</label>
            <input type="text" name="articleLink"size="100" required /><br>
            
            <label for="articleDate">Article Date:</label>
            <input type="date" name="articleDate" required/><br>

            <label for="articleImage">Link an image for the article:</label>
            <input type="text" name="articleImage"required /><br>
         

        <label for= "articleText"> Article Text:</label>
        <textarea  type="text" name="articleText" form_Id="editform" rows="40" cols="50"> </textarea>


    </fieldset>
        <input type="submit" /> 
    </form>

   
    </body>
    </html> <?php
    
} else {

?><h1> You are not Authorized to Insert Articles <?php echo($_SESSION["username"]) ?> </h1>
<p> Please ensure you are authorized to insert articles by <a href= "login.php"> logging in as an admin </a></p> <?php

}



?>