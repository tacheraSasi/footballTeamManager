<?php
require_once __DIR__ . '/app/app.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-neutral-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-neutral-800">Register</h2>
        <?php App::flashErrors(); ?>
        <form action="handlers/register.php" method="POST" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-neutral-700">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full p-3 border-neutral-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full p-3 border-neutral-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-neutral-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full p-3 border-neutral-600 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700">Register</button>
        </form>
        <p class="mt-4 text-sm text-center text-neutral-600">
            Already have an account? <a href="login.php" class="text-indigo-500 hover:underline">Login</a>
        </p>
    </div>
</body>
</html>
