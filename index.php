<?php

session_start();

if(isset($_SESSION["user_id"])){

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user WHERE  id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

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
    <div class="text-center grid gap-4">
        <h1 class="text-4xl uppercase">Home</h1>

        <?php if (isset($user)): ?>
            <p>Hello <?= htmlspecialchars($user["name"]) ?> you are logged in.</p>
            <p><a href="logout.php">Log out</a></p>
        <?php else: ?>
            <p><a href="login.php">Log In</a> or <a href="signup.html">Sign Up</a></p>
        <?php endif; ?>

    </div>
</body>

</html>