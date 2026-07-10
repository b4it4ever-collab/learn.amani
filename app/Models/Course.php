<?php
namespace App\Models;

use App\Core\Database;

class Course {
    public static function create($data) {
        $db = Database::getInstance();
        $stmt = $db->prepare("INSERT INTO courses (title, description, category_id) VALUES (?, ?, ?)");
        return $stmt->execute([$data['title'], $data['description'], $data['category_id']]);
    }

    public static function all() {
        return Database::getInstance()->query("SELECT * FROM courses")->fetchAll();
    }
}
