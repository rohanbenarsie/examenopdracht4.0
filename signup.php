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
        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
        }
        #button {
            padding: 10px;
            width: 100px;
            color: white;
            background-color: lightblue;
            border: none;
        }
        #box {
            background-color: grey;
            margin: auto;
            width: 300px;
            padding: 20px;
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
