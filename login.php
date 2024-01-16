<?php

session_start();
include 'connection.php';
include 'function.php';

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name))
    {

        //read to database
        $query = "select * from users where user_name = '$user_name' AND password = '$password' limit 1";

        $result = mysqli_query( $con, $query);
         
        if($result)
       {
        if ($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);

         if ($user_data['password'] == $password) 
            {
                $_SESSION['user_id'] = $user_data['user_id'];
                header("Location: index.php");
                die;
            }
            // var_dump($user_name, $password, $user_data['password']);


        }
         $errors[] ="username or password incorrect";
       }
    

    } else if($user_name === "")
    {
        $errors[] ="username form missing";
    } else if($password == "")
    {
        $errors[] ="password form missing";
    }
    else
    {
        $errors[] ="username or password incorrect";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="box">
      <form action="" method="post">
        <div><h1 class="title">Login</h1></div>
        <input type="text" name ="user_name" class="input" placeholder="Username"> <br>
        <input type="password" name ="password" class="input" placeholder="Password"> <br>

        <input type="submit" value="Login" class=" send"> <br>
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

        <a href="signup.php" class="a"> Dont have an account: Sign up</a> <br>
      </form>
    </div>
</body>
</html>