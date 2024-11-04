<?php
session_start();

include("connection.php");
include("functions.php");

// Controleer of de gebruiker is ingelogd, anders doorsturen naar signup.php
$user_data = check_login($con);

// Als de gebruiker niet is ingelogd, stuur door naar signup.php
if (!isset($_SESSION['user_id'])) {
    header("Location: signup.php"); // Zorg ervoor dat ze altijd naar signup.php gaan als ze niet zijn ingelogd
    die;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My website</title>
        <style>
            body{
                background-color: #f9f9e9;
            }       
            
            </style>
    </head>
    <body>

    <!-- Voeg de logout-knop toe -->
    <a href="logout.php">Logout</a>
    <h1>Welkom op de indexpagina</h1>
    <p>Hello, <?php echo $user_data['user_name']; ?></p>

    </body>
</html>
