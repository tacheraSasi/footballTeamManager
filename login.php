<?php
require_once __DIR__ . '/app/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector(".login-container").classList.add("opacity-100", "translate-y-0");
        });
    </script>
    <style>
        .login-container {
            opacity: 0;
            transform: translateY(-20px);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-300 flex items-center justify-center h-screen">
    <div class="login-container bg-white p-8 rounded-xl shadow-xl w-full max-w-md border border-gray-200">
        <h2 class="text-3xl font-bold text-center text-neutral-800 mb-6">Login</h2>
        
        <?php App::flashErrors(); ?>
        
        <form action="handlers/login.php" method="POST" class="space-y-5">
            <div>
                <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                <input type="email" id="email" name="email" required 
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-neutral-700">Password</label>
                <input type="password" id="password" name="password" required 
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-300">
            </div>
            <button type="submit" 
                class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-[1.02] hover:shadow-lg hover:bg-indigo-700">
                Login
            </button>
        </form>
        
        <p class="mt-5 text-sm text-center text-neutral-600">
            Don't have an account? <a href="register.php" class="text-indigo-500 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
