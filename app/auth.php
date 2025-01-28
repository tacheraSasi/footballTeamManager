<?php
// Loading required files
require __DIR__ . './app.php';
require __DIR__ . './db.php';
require_once __DIR__ . '/../../parseEnv.php'; 

// Parsing environment variables
parseEnv(__DIR__ . '../.env');

// Retrieving environment variables
$host = getenv("DB_HOST");
$dbname = getenv("DB_NAME");
$username = getenv("DB_USERNAME");
$password = getenv("DB_PASSWORD");

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

// Connecting to the DB
DB::connect($dsn, $username, $password);

// Auth class extending the DB
class Auth extends DB {
    public function __construct() {}

    public static function user() {
        return $_SESSION['user'] ?? null; // Returns null if 'user' is not set
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

    public static function register(string $username, string $email, string $password) {
        $hashed_password = password_hash(password: $password, algo: PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, email, password) VALUES (:name, :email, :password)";
        $isRegistered = self::query(sql: $sql, params: [
            'name' => $username,
            'email' => $email,
            'password' => $hashed_password,
        ]);

        if (!$isRegistered) {
            return App::error(message: "Failed to register the user. Something went wrong.");
        }

        return App::redirect(url: 'login.php');
    }

    public static function logout() {
        session_start();
        session_destroy();
        App::redirect("login.php");
    }

    public static function hasRole(string $role): bool {
        $user = self::user();
        return $user && $user["role"] === $role;
    }

    public static function restrictTo(string $role) {
        if (!self::hasRole($role)) {
            App::error("Unauthorized access.");
            App::redirect("login.php");
        }
    }

    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }
}
