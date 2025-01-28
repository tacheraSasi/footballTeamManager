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
}