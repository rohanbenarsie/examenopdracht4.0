<?php

function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Stuur de gebruiker naar de login-pagina als hij niet is ingelogd
    header("Location: login.php");
    die;
}




function random_num($length)
{

    $text = "";
    if($length < 5)
    {
        $length = 5;  
    }

    $len = rand(4, $length);

    for ($i=0; $i < $len; $i++){


        $text .= rand(0,9);
    }

    return $text;
}