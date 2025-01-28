<?php
require __DIR__ . '/db.php'; 

// Seed Users
function seedUsers() {
    $users = [
        ['username' => 'admin', 'email' => 'admin@team.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT), 'role' => 'admin'],
        ['username' => 'tech_director', 'email' => 'director@team.com', 'password' => password_hash('director123', PASSWORD_DEFAULT), 'role' => 'technical_director'],
        ['username' => 'staff1', 'email' => 'staff1@team.com', 'password' => password_hash('staff123', PASSWORD_DEFAULT), 'role' => 'staff'],
        ['username' => 'staff2', 'email' => 'staff2@team.com', 'password' => password_hash('staff123', PASSWORD_DEFAULT), 'role' => 'staff'],
    ];

    foreach ($users as $user) {
        DB::query(
            "INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)",
            $user
        );
    }
}

// Seed Players
function seedPlayers() {
    $players = [
        ['name' => 'John Doe', 'age' => 25, 'position' => 'Striker', 'status' => 'active'],
        ['name' => 'Mike Tyson', 'age' => 22, 'position' => 'Midfielder', 'status' => 'active'],
        ['name' => 'Leo Messi', 'age' => 30, 'position' => 'Forward', 'status' => 'active'],
        ['name' => 'Cristiano Ronaldo', 'age' => 35, 'position' => 'Forward', 'status' => 'active'],
        ['name' => 'David Beckham', 'age' => 28, 'position' => 'Winger', 'status' => 'injured'],
        ['name' => 'Sergio Ramos', 'age' => 33, 'position' => 'Defender', 'status' => 'active'],
        ['name' => 'Manuel Neuer', 'age' => 34, 'position' => 'Goalkeeper', 'status' => 'active'],
        ['name' => 'Kylian Mbappe', 'age' => 24, 'position' => 'Forward', 'status' => 'active'],
        ['name' => 'Neymar Jr', 'age' => 29, 'position' => 'Winger', 'status' => 'suspended'],
        ['name' => 'Paul Pogba', 'age' => 27, 'position' => 'Midfielder', 'status' => 'active'],
    ];

    foreach ($players as $player) {
        DB::query(
            "INSERT INTO players (name, age, position, status) VALUES (:name, :age, :position, :status)",
            $player
        );
    }
}

// Seed Technical Team
function seedTechnicalTeam() {
    $technicalTeam = [
        ['name' => 'Zinedine Zidane', 'role' => 'coach'],
        ['name' => 'John Smith', 'role' => 'doctor'],
        ['name' => 'Emily Watson', 'role' => 'physiotherapist'],
        ['name' => 'Carlo Ancelotti', 'role' => 'coach'],
        ['name' => 'Sarah Johnson', 'role' => 'physiotherapist'],
    ];

    foreach ($technicalTeam as $member) {
        DB::query(
            "INSERT INTO technical_team (name, role) VALUES (:name, :role)",
            $member
        );
    }
}

try {
    
    DB::connect("mysql:host=localhost;dbname=football_team", "root", ""); // Replace with your DB credentials

    // Seeding the database
    seedUsers();
    seedPlayers();
    seedTechnicalTeam();

    echo "Database seeded successfully!\n";
} catch (Exception $e) {
    echo "Error seeding database: " . $e->getMessage() . "\n";
}