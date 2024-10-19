<?php 

$is_invalid = false;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'", 
    $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc(); 

    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
            exit;
        }
    }

    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/output.css">
    <title>Login</title>
</head>
<body class="h-screen flex justify-center items-center">
    <form action="" method="post" class="grid gap-2 shadow-lg max-w-80 w-full p-6 rounded-md bg-slate-50" novalidate>
      <h1 class="text-4xl text-center uppercase">Login</h1>
      <?php if($is_invalid): ?>
        <p class="text-red-600 text-center">Invalid Login</p>
      <?php endif; ?>
        <div class="flex flex-col space-y-2">
            <label for="email" class="text-md text-slate-900 font-semibold">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-300 p-2 rounded-sm" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </div>
        <div class="flex flex-col space-y-2">
            <label for="password" class="text-md text-slate-900 font-semibold">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-300 p-2 rounded-sm">
        </div>
        <input type="submit" value="Login" class="bg-gray-300 border-solid border-2 border-slate-500 text-slate-900 font-bold p-2 rounded-md mt-4 cursor-pointer">
    </form>
</body>
</html>