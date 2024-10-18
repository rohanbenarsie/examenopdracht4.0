<?php
session_start();

include("connection.php");
include("functions.php");

$user_data = check_login($con);

// Controleer of de gebruiker is ingelogd
if (!isset($_SESSION['user_id'])) {
    // Gebruiker is niet ingelogd, doorverwijzen naar de signup pagina
    header("Location: signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>My website</title>
</head>
<body>

    <a href="logout.php">Logout</a>
    <h1>Welcome to the index page</h1>

    <br>
    Hello, <?php echo $user_data['user_name']; ?>
</body>
</html>
