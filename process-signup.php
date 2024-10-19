<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email address is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Passwords must contain at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Passwords must contain at least one lowercase letter");
}

if (!preg_match("/[A-Z]/i", $_POST["password"])) {
    die("Passwords must contain at least one uppercase letter");
}

if (!preg_match("/[0-9]/i", $_POST["password"])) {
    die("Passwords must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords don't match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);

$mysqli = require __DIR__ . "/database.php";

try {
    $sql = "INSERT INTO user (name, email, password_hash) VALUES (?, ?, ?)";
    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql)) {
        throw new Exception("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("sss", $_POST["name"], $_POST["email"], $password_hash);

    if ($stmt->execute()) {
        header("Location: signup-success.html");
        exit;
    }
} catch (mysqli_sql_exception $e) {
    if ($e->getCode() === 1062) {
        die("Email already taken");
    } else {
        die($e->getMessage() . " " . $e->getCode());
    }
} catch (Exception $e) {
    die($e->getMessage());
}
