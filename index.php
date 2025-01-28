<?php
require_once __DIR__ . '/app/auth.php';
require_once __DIR__ . '/app/player.php';
require_once __DIR__ . '/app/app.php';

// Redirects to login if not logged in
if (!Auth::isLoggedIn()) {
    App::redirect('login.php');
}

$isAdmin = Auth::isAdmin();
$isTechnicalDirector = Auth::isTechnicalDirector();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'addPlayer':
            Player::addPlayer($_POST['name'], $_POST['position'], $_POST['age'], $_POST['status']);
            break;
        case 'updatePlayer':
            Player::updatePlayer($_POST['id'], $_POST['name'], $_POST['position'], $_POST['age'], $_POST['status']);
            break;
        case 'deletePlayer':
            Player::deletePlayer($_POST['id']);
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teamAction'])) {
    switch ($_POST['teamAction']) {
        case 'addMember':
            TechnicalTeam::addMember($_POST['name'], $_POST['role']);
            break;
        case 'updateMember':
            TechnicalTeam::updateMember($_POST['id'], $_POST['name'], $_POST['role']);
            break;
        case 'deleteMember':
            TechnicalTeam::deleteMember($_POST['id']);
            break;
    }
}

$players = Player::getPlayers();
$teamMembers = TechnicalTeam::getMembers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="container mx-auto py-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-700">Dashboard</h1>
            <form action="logout.php" method="POST">
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Logout</button>
            </form>
        </div>

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Players Section -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Players</h2>
                <?php if ($isTechnicalDirector): ?>
                    <form method="POST" class="mb-4">
                        <input type="hidden" name="action" value="addPlayer">
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-4 items-center">
                            <input type="text" name="name" placeholder="Name" class="p-2 border rounded" required>
                            <input type="text" name="position" placeholder="Position" class="p-2 border rounded" required>
                            <input type="number" name="age" placeholder="Age" class="p-2 border rounded" required>
                            <select name="status" class="p-2 border rounded">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Player</button>
                    </form>
                <?php endif; ?>

                <table class="table-auto w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Position</th>
                            <th class="px-4 py-2">Age</th>
                            <th class="px-4 py-2">Status</th>
                            <?php if ($isTechnicalDirector): ?>
                                <th class="px-4 py-2">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($players as $player): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?php echo htmlspecialchars($player['name']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($player['position']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($player['age']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($player['status']); ?></td>
                                <?php if ($isTechnicalDirector): ?>
                                    <td class="px-4 py-2">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="action" value="deletePlayer">
                                            <input type="hidden" name="id" value="<?php echo $player['id']; ?>">
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Technical Team Section -->
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Technical Team</h2>
                <?php if ($isAdmin): ?>
                    <form method="POST" class="mb-4">
                        <input type="hidden" name="teamAction" value="addMember">
                        <div class="grid grid-cols-1 gap-2 md:grid-cols-3 items-center">
                            <input type="text" name="name" placeholder="Name" class="p-2 border rounded" required>
                            <input type="text" name="role" placeholder="Role" class="p-2 border rounded" required>
                        </div>
                        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Add Member</button>
                    </form>
                <?php endif; ?>

                <table class="table-auto w-full text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">Name</th>
                            <th class="px-4 py-2">Role</th>
                            <?php if ($isAdmin): ?>
                                <th class="px-4 py-2">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teamMembers as $member): ?>
                            <tr class="border-t">
                                <td class="px-4 py-2"><?php echo htmlspecialchars($member['name']); ?></td>
                                <td class="px-4 py-2"><?php echo htmlspecialchars($member['role']); ?></td>
                                <?php if ($isAdmin): ?>
                                    <td class="px-4 py-2">
                                        <form method="POST" class="inline">
                                            <input type="hidden" name="teamAction" value="deleteMember">
                                            <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
                                            <button type="submit" class="text-red-500">Delete</button>
                                        </form>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
