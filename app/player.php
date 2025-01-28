<?php 

// Add player
function addPlayer($name, $age, $position) {
    Auth::restrictTo('TECHNICAL_DIRECTOR');
    $sql = "INSERT INTO players (name, age, position) VALUES (:name, :age, :position)";
    return DB::query($sql, ['name' => $name, 'age' => $age, 'position' => $position]);
}

// Update player
function updatePlayer($id, $name, $age, $position, $status) {
    Auth::restrictTo('TECHNICAL_DIRECTOR');
    $sql = "UPDATE players SET name = :name, age = :age, position = :position, status = :status WHERE id = :id";
    return DB::query($sql, ['id' => $id, 'name' => $name, 'age' => $age, 'position' => $position, 'status' => $status]);
}

// Delete player
function deletePlayer($id) {
    Auth::restrictTo('TECHNICAL_DIRECTOR');
    $sql = "DELETE FROM players WHERE id = :id";
    return DB::query($sql, ['id' => $id]);
}

// Get all players
function getPlayers() {
    return DB::fetchAll("SELECT * FROM players");
}
