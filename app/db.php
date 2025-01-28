<?php 
class DB{
    public static ?PDO $conn = null;

    public static function connect(string $dsn, string $username = '', string $password = '', array $options = []){
        try {
            self::$conn = new PDO($dsn, $username, $password, $options);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error while connecting to the db ".$e->getMessage());
        }
    }

    public static function query(string $sql, array $params = []): bool|PDOStatement {
        if (!self::$conn) {
            throw new Exception("DB not connected. Call DB::connect() first.");
        }

        try {
            $stmt = self::$conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

    public static function fetchAll(string $sql, array $params = []): array {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public static function fetchOne(string $sql, array $params = []): array|false {
        $stmt = self::query($sql, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public static function fetchObjects(string $sql, array $params = [], string $className): array {
        $stmt = self::query($sql, $params);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $className);
    }

}

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
