<?php

use App\Core\Database;

class CreateCertificateNotificationTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS certificate_templates (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL,
                subject VARCHAR(255) NULL,
                body_template TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS certificates (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                course_id BIGINT UNSIGNED NOT NULL,
                template_id BIGINT UNSIGNED NULL,
                certificate_number VARCHAR(100) NOT NULL UNIQUE,
                issued_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
                FOREIGN KEY (template_id) REFERENCES certificate_templates(id) ON DELETE SET NULL,
                INDEX idx_certificates_user (user_id),
                INDEX idx_certificates_course (course_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS notifications (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                is_read TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                INDEX idx_notifications_user (user_id),
                INDEX idx_notifications_unread (is_read)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS messages (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                sender_id BIGINT UNSIGNED NOT NULL,
                receiver_id BIGINT UNSIGNED NOT NULL,
                subject VARCHAR(255) NULL,
                body TEXT NOT NULL,
                is_read TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (sender_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (receiver_id) REFERENCES users(id) ON DELETE CASCADE,
                INDEX idx_messages_sender (sender_id),
                INDEX idx_messages_receiver (receiver_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS messages');
        $db->connection()->exec('DROP TABLE IF EXISTS notifications');
        $db->connection()->exec('DROP TABLE IF EXISTS certificates');
        $db->connection()->exec('DROP TABLE IF EXISTS certificate_templates');
    }
}
