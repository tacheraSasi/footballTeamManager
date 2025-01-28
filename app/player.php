<?php 
require_once __DIR__ . '/db.php';
class Player extends DB {
    public static function addPlayer($name, $position, $age, $status = 'active') {
        if (!Auth::isTechnicalDirector()) {
            return App::error("Only the technical director can add players.");
        }

        $sql = "INSERT INTO players (name, position, age, status) VALUES (:name, :position, :age, :status)";
        return self::query($sql, [
            'name' => $name,
            'position' => $position,
            'age' => $age,
            'status' => $status
        ]);
    }

    public static function updatePlayer($id, $name, $position, $age, $status) {
        if (!Auth::isTechnicalDirector()) {
            return App::error("Only the technical director can update players.");
        }

        $sql = "UPDATE players SET name = :name, position = :position, age = :age, status = :status WHERE id = :id";
        return self::query($sql, [
            'id' => $id,
            'name' => $name,
            'position' => $position,
            'age' => $age,
            'status' => $status
        ]);
    }

    public static function deletePlayer($id) {
        if (!Auth::isTechnicalDirector()) {
            return App::error("Only the technical director can delete players.");
        }

        $sql = "DELETE FROM players WHERE id = :id";
        return self::query($sql, ['id' => $id]);
    }

    public static function getPlayers() {
        $sql = "SELECT * FROM players";
        return self::fetchAll($sql);
    }
}

class TechnicalTeam extends DB {
    public static function addMember($name, $role) {
        if (!Auth::isAdmin()) {
            return App::error("Only the admin can add technical team members.");
        }

        $sql = "INSERT INTO technical_team (name, role) VALUES (:name, :role)";
        return self::query($sql, [
            'name' => $name,
            'role' => $role
        ]);
    }

    public static function updateMember($id, $name, $role) {
        if (!Auth::isAdmin()) {
            return App::error("Only the admin can update technical team members.");
        }

        $sql = "UPDATE technical_team SET name = :name, role = :role WHERE id = :id";
        return self::query($sql, [
            'id' => $id,
            'name' => $name,
            'role' => $role
        ]);
    }

    public static function deleteMember($id) {
        if (!Auth::isAdmin()) {
            return App::error("Only the admin can delete technical team members.");
        }

        $sql = "DELETE FROM technical_team WHERE id = :id";
        return self::query($sql, ['id' => $id]);
    }

    public static function getMembers() {
        $sql = "SELECT * FROM technical_team";
        return self::fetchAll($sql);
    }
}