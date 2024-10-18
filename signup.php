<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Gebruikersinvoer ophalen
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Validatie
    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
        // Genereer een unieke gebruikers-ID
        $user_id = random_num(20);

        // Wachtwoord hashen voor veilige opslag
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL-query om gebruiker op te slaan
        $query = "INSERT INTO users (user_id, user_name, password) VALUES ('$user_id', '$user_name', '$hashed_password')";

        // Voer de query uit en controleer op fouten
        if (mysqli_query($con, $query)) {
            // Redirect naar index.html na succesvolle registratie
            header("Location: index.html");
            die; // Stop verdere uitvoering
        } else {
            echo "Fout bij registratie: " . mysqli_error($con);
        }
    } else {
        echo "Vul een geldige gebruikersnaam en wachtwoord in!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup</title>
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
            <div style="font-size: 20px;margin: 10px;">Signup</div>
            <input id="text" type="text" name="user_name" required><br><br>
            <input id="text" type="password" name="password" required><br><br>
            <input id="button" type="submit" name="Signup" value="Signup"><br><br>
            <a href="login.php">Heb je al een account? Log hier in</a><br><br>
        </form>
    </div>
</body>
</html>
