<?php


if (empty($_POST["name"])) {
    die("Name is required");
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email address is required");
}

if (strlen($_POST["password"]) < 8){
    die("Passwords must contain atleast 8 characters");
}

if (! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Passwords must contain atleast one simple letter");
}

if (! preg_match("/[A-Z]/i", $_POST["password"])) {
    die("Passwords must contain atleast one capital letter");
} 

if (! preg_match("/[0-9]/i", $_POST["password"])) {
    die("Passwords must contain atleast one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]){
    die("passwords don't match ");
}



$password_hash = password_hash($_POST["password"], PASSWORD_BCRYPT);

$mysqli = require __DIR__ . "/database.php";

print_r($_POST);
var_dump($password_hash);