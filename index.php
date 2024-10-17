<?php
    session_start();

    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>


<!DOCTYPE html>
<html>
    <head>
        <title>My website</title>
    </head>
    <body>

    <a href="logout.php">Logout</a>
    <h1>this is the index.php </h1>

    <br>
    hello <?php echo $user_data['user_name']; ?>
    </body>
</html>