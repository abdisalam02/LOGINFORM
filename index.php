<?php

session_start();

include 'connection.php';
include 'function.php';

$user_data = check_login($con); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body>

<div class="box">
    <h1 class="title">Congratulations you are logged in</h1>
    
    <br>
    hello, <?php echo $user_data['user_name']; ?>
    
    <a href="logout.php" class="a">Logout</a>
</div>
</body>
</html>