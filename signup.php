<?php

session_start();
include 'connection.php';
include 'function.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    // $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    // $email = $_POST['email'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        //save to database
        $user_id = random_num(20);
        $query = "INSERT INTO users (user_id, user_name, password, date) VALUES ('$user_id', '$user_name', '$password', NOW())";

        $result = mysqli_query( $con, $query);

        if($result){
            echo "Database connection is working"; // Add a message to check if the database connection is working
        } else {
            echo "Database connection error: " . mysqli_error($con); // Display the error message if there's an issue
        }

        header("Location: login.php");
    } else if($email == "")
    {
        $errors[] ="email form missing";
    } else if($user_name == "" )
    {
        $errors[] ="username form missing";
    } else if($password == "")
    {
        $errors[] ="password form missing";
    }
    else
    {
        $errors[] ="enter some valid info";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Signup</title>
</head>
<body>
    <div class="box">
      <form action="" method="post">
        <div><h1 class="title">Signup</h1></div>
        <input type="text" name ="email" class="input" placeholder="Email"> <br>
        <input type="text" name ="user_name" class="input" placeholder="Username"> <br>
        <input type="password" name ="password" class="input" placeholder="Password"> <br>

        <input type="submit" value="Sign up" class=" send"> <br>

        <?php
        // Display error messages
        if (!empty($errors)) {
            echo '<div class="error-message">';
            foreach ($errors as $error) {
                echo $error . '<br>';
            }
            echo '</div>';
        }
        ?>
        <a href="login.php" class="a"> Click to Login</a> <br>
      </form>
    </div>
</body>
</html>