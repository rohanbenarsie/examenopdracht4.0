<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Gebruikersinvoer ophalen
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // SQL-query om gebruiker te vinden
    $query = "SELECT * FROM users WHERE user_name = '$user_name' LIMIT 1";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);

        // Controleer het wachtwoord
        if (password_verify($password, $user_data['password'])) {
            $_SESSION['user_id'] = $user_data['user_id']; // Sla de gebruikers-ID op in de sessie
            header("Location: index.html"); // Verander deze regel naar index.html
            exit(); // Stop verdere uitvoering
        } else {
            echo "Ongeldig wachtwoord.";
        }
    } else {
        echo "Geen gebruiker gevonden.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style type="text/css">
      
body {
    background-color: #f9f9e9;; /
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

        #text {
            
    height: 30px; /* Iets hoger */
    border-radius: 5px;
    padding: 10px; /* Grotere padding binnenin de velden */
    border: solid thin #aaa;
    width: 100%; /* Zorg dat de velden 100% van de boxbreedte zijn */
    font-size: 18px; /* Grotere tekst */
}

        
#button {
    padding: 15px; /* Grotere knop */
    width: 50%; /* Zorg dat de knop net zo breed is als de invoervelden */
    color: black;
    background-color: #f9f9e9;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px; /* Grotere tekst in de knop */
}

        #box {
            background-color: lightgray;
            margin: auto;
            width: 1200px;
            height: 600px;
            padding: 80px;
        }
            
    </style>
</head>
<body>
    <div id="box">
        <form method="post">
            <div style="font-size: 20px;margin: 10px;">Login</div>
            <input id="text" type="text" name="user_name" required><br><br>
            <input id="text" type="password" name="password" required><br><br>
            <input id="button" type="submit" name="Login" value="Login"><br><br>
            <a href="signup.php">Heb je geen account? Registreer hier</a><br><br>
        </form>
    </div>
</body>
</html>
