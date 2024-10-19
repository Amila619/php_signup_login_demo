<?php

session_start();

print_r($_SESSION);  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/output.css">
    <title>Home</title>
</head>
<body class="h-screen flex justify-center items-center">
    <h1 class="text-4xl text-center uppercase">Home</h1>

    <?php if (isset($_SESSION["user_id"])): ?>
        <p>You are logged in.</p>
    <?php else: ?>
        <p><a href="login.php">Log In</a> or <a href="signup.html">Sign Up</a></p>
    <?php endif; ?>

</body>
</html>