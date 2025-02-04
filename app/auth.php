<?php
require __DIR__ . '/app.php';
require __DIR__ . '/db.php';


class Auth extends DB {
    public function __construct() {}

    public static function user() {
        return $_SESSION['user'] ?? null;
    }

    public static function isTechnicalDirector() {
        return self::user() && self::user()['role'] === 'technical_director';
    }

    public static function isAdmin() {
        return self::user() && self::user()['role'] === 'admin';
    }

    public static function comparePass($pass1, $pass2) {
        return $pass1 === $pass2;
    }

    public static function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $user = self::fetchOne($sql, ["email" => $email]);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["user"] = $user;
            return App::redirect("index.php");
        }

        return App::error("Invalid credentials. Failed to login.");
    }

    public static function register(string $username, string $email, string $password, string $role = 'staff') {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password, role) VALUES (:name, :email, :password, :role)";
        $isRegistered = self::query($sql, [
            'name' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'role' => $role
        ]);

        if (!$isRegistered) {
            return App::error("Failed to register the user. Something went wrong.");
        }

        return App::redirect('login.php');
    }

    public static function logout() {
        session_start();
        session_destroy();
        App::redirect("login.php");
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }
}
