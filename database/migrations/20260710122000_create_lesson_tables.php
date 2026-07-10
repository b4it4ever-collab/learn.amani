<?php

use App\Core\Database;

class CreateLessonTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS lessons (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                section_id BIGINT UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NULL,
                content_placeholder TEXT NULL,
                duration_minutes INT NOT NULL DEFAULT 0,
                sort_order INT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (section_id) REFERENCES course_sections(id) ON DELETE CASCADE,
                INDEX idx_lessons_section (section_id),
                INDEX idx_lessons_order (sort_order)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS lesson_resources (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                lesson_id BIGINT UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                resource_type VARCHAR(50) NOT NULL DEFAULT 'file',
                file_url VARCHAR(500) NULL,
                external_url VARCHAR(500) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
                INDEX idx_resources_lesson (lesson_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS lesson_progress (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                lesson_id BIGINT UNSIGNED NOT NULL,
                completed TINYINT(1) NOT NULL DEFAULT 0,
                completed_at TIMESTAMP NULL DEFAULT NULL,
                watch_time_minutes INT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
                UNIQUE KEY uq_lesson_progress (user_id, lesson_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS course_progress (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                course_id BIGINT UNSIGNED NOT NULL,
                completed_lessons INT NOT NULL DEFAULT 0,
                total_lessons INT NOT NULL DEFAULT 0,
                progress_percent DECIMAL(5,2) NOT NULL DEFAULT 0.00,
                completed TINYINT(1) NOT NULL DEFAULT 0,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
                UNIQUE KEY uq_course_progress (user_id, course_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS course_progress');
        $db->connection()->exec('DROP TABLE IF EXISTS lesson_progress');
        $db->connection()->exec('DROP TABLE IF EXISTS lesson_resources');
        $db->connection()->exec('DROP TABLE IF EXISTS lessons');
    }
}
