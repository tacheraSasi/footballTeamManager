<?php
session_start();

// Initializes errors session variable as an array
// $_SESSION["errors"];

class App
{
    public static function redirect(string $url, int $code = 302)
    {
        // Sends a redirect header
        header("Location: $url", true, $code);
        exit();
    }

    public static function error(string $message) {
        $_SESSION["errors"][] = $message;
    }

    public static function flashErrors() {
        if (!empty($_SESSION["errors"])) {
            foreach ($_SESSION["errors"] as $error) {
                echo "<div class='error'>$error</div>";
            }
            $_SESSION["errors"] = [];
        }
    }


}

class Str
{
    public static function slug(string $str)
    {
        return strtolower(
            preg_replace(
                "/[^a-zA-Z0-9]+/", // pattern: Match non-alphanumeric characters
                "-",              // replacement: Replace with "-"
                $str              // subject: The input string
            )
        );
    }

}
