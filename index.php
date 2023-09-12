<?php
session_start();
if(isset($_SESSION["user_id"]))
{
    $mysqli = require __DIR__ . '/database.php';
    
    $sql= "SELECT * FROM user
           WHERE id ={$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
        }

        a {
            color: #007BFF;
            text-decoration: none;
            margin: 0 10px;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Style for the "You are logged in" message */
        .logged-in-message {
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Home</h1>
    <?php if(isset($user)): ?>
        <p class="logged-in-message">Hello <?=htmlspecialchars($user["name"])?></p>
        <p><a href="logout.php">Log out</a></p>
    <?php else: ?>
        <p><a href="login.php">Log in</a> or <a href="signup.html">Sign up</a></p>
    <?php endif;?>
</body>
</html>
