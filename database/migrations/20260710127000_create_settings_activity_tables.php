<?php

use App\Core\Database;

class CreateSettingsActivityTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS settings (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                key_name VARCHAR(150) NOT NULL UNIQUE,
                value_text TEXT NULL,
                value_json JSON NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                INDEX idx_settings_key (key_name)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS activity_logs (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NULL,
                action VARCHAR(150) NOT NULL,
                subject_type VARCHAR(100) NULL,
                subject_id BIGINT UNSIGNED NULL,
                metadata JSON NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
                INDEX idx_activity_user (user_id),
                INDEX idx_activity_action (action)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS activity_logs');
        $db->connection()->exec('DROP TABLE IF EXISTS settings');
    }
}
