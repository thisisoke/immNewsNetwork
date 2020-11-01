<?php
//Login PHP 



?>

<!DOCTYPE html>

<html>

<head>
    <!-- link favicon, title the page,  -->
    <!-- title: Contact  -->
</head>
<body>
    <h1> Login Page </h1>

<!--  Form to Login-->
<h2> Have an Account? Login here </h2>
<form action="login-process.php" method="POST"> 
    Username:<input type="text" name="username" />
    Password: <input type="password" name="password" />
   <input type="submit" />
</form>

<!-- Form to register an account -->
<h2> Don't Have An Account? Register here: </h2>
<form action="register-process.php" method="POST"> 
    Select a User name<input type="text" name="username" />
    Make a Password: <input type="password" name="password" />
    Email: <input type="email" name="email" />

    <input type="hidden" name="userType" value="registered">

   <input type="submit" />
</form>


<!-- Link back to homepage -->
<h2> Visit Home Page </h2>
<p>Go to <a href="articles-list.php">Article Home Page</a> without logging in </p>


</body>
</html>