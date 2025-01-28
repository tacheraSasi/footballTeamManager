<?php
require_once '../app/auth.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if ($email && $password) {
    Auth::login($email, $password);
} else {
    App::error("Please fill out all fields.");
    App::redirect("login.php");
}
