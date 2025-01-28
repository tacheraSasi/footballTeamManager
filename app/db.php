<?php 
class DB{
    public static ?PDO $conn = null;

    public static function connect(string $dsn, string $username = '', string $password = '', array $options = []){
        try {
            self::$conn = new PDO($dsn, $username, $password, $options);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error while connect to the db ".$e->getMessage());
        }
    }

    public static function query(string $sql, array $params = []): bool|PDOStatement {
        if (!self::$conn) {
            throw new Exception("Database not connected. Call Database::connect() first.");
        }

        try {
            $stmt = self::$conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }

}