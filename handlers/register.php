<?php
require_once __DIR__ . '../app/auth.php';

$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $email && $password) {
    Auth::register($username, $email, $password);
} else {
    App::error("Please fill out all fields.");
    App::redirect("register.php");
}
