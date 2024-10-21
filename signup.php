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
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style type="text/css">
        body {
            background-color: #f9f9e9;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #text {
            height: 40px; /* Verhoogd voor betere gebruiksvriendelijkheid */
            border-radius: 5px;
            padding: 10px; /* Grotere padding binnenin de velden */
            border: solid thin #aaa;
            width: 100%; /* Zorg dat de velden 100% van de boxbreedte zijn */
            font-size: 18px; /* Grotere tekst */
        }

        #button {
            padding: 15px; /* Grotere knop */
            width: 100%; /* Zorg dat de knop net zo breed is als de invoervelden */
            color: black;
            background-color: #f9f9e9;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px; /* Grotere tekst in de knop */
            transition: background-color 0.3s ease; /* Voor hover-effect */
        }

        #button:hover {
            background-color: #e0e0e0; /* Hover-effect voor de knop */
        }

        #box {
            background-color: lightgray;
            margin: auto;
            width: 90%; /* Breder voor mobiele apparaten */
            max-width: 400px; /* Max breedte voor grotere schermen */
            height: auto; /* Automatisch hoogte voor responsiviteit */
            padding: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Schaduw voor een betere uitstraling */
            border-radius: 10px; /* Ronde hoeken */
        }

        /* Responsieve stijlen */
        @media (max-width: 768px) {
            #box {
                padding: 20px; /* Minder padding op kleinere schermen */
            }
        }

        /* Titels */
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            display: block; /* Maak de link blokken voor betere klikruimte */
            text-align: center; /* Center de tekst */
            margin-top: 10px; /* Ruimte boven de link */
        }
    </style>
</head>
<body>
    <div id="box">
        <h2>Signup</h2> <!-- Gebruik een koptekst voor betere semantiek -->
        <form method="post">
            <input id="text" type="text" name="user_name" placeholder="Gebruikersnaam" required><br><br>
            <input id="text" type="password" name="password" placeholder="Wachtwoord" required><br><br>
            <input id="button" type="submit" name="Signup" value="Signup"><br><br>
            <a href="login.php">Heb je al een account? Log hier in</a><br>
        </form>
    </div>
</body>
</html>
