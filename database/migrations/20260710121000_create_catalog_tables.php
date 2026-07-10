<?php

use App\Core\Database;

class CreateCatalogTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS categories (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL UNIQUE,
                slug VARCHAR(180) NOT NULL UNIQUE,
                description TEXT NULL,
                icon VARCHAR(100) NULL,
                color VARCHAR(20) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                INDEX idx_categories_slug (slug)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS tags (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(120) NOT NULL UNIQUE,
                slug VARCHAR(150) NOT NULL UNIQUE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS courses (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                slug VARCHAR(255) NOT NULL UNIQUE,
                short_description TEXT NULL,
                description LONGTEXT NULL,
                category_id BIGINT UNSIGNED NOT NULL,
                instructor_id BIGINT UNSIGNED NOT NULL,
                thumbnail_url VARCHAR(500) NULL,
                price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
                currency VARCHAR(10) NOT NULL DEFAULT 'USD',
                difficulty VARCHAR(30) NOT NULL DEFAULT 'beginner',
                status VARCHAR(30) NOT NULL DEFAULT 'draft',
                featured TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT,
                FOREIGN KEY (instructor_id) REFERENCES users(id) ON DELETE RESTRICT,
                INDEX idx_courses_status (status),
                INDEX idx_courses_category (category_id),
                INDEX idx_courses_instructor (instructor_id),
                INDEX idx_courses_featured (featured)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS course_tags (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                course_id BIGINT UNSIGNED NOT NULL,
                tag_id BIGINT UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
                FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE,
                UNIQUE KEY uq_course_tag (course_id, tag_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS course_sections (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                course_id BIGINT UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NULL,
                sort_order INT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
                INDEX idx_sections_course (course_id),
                INDEX idx_sections_order (sort_order)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS course_tags');
        $db->connection()->exec('DROP TABLE IF EXISTS course_sections');
        $db->connection()->exec('DROP TABLE IF EXISTS courses');
        $db->connection()->exec('DROP TABLE IF EXISTS tags');
        $db->connection()->exec('DROP TABLE IF EXISTS categories');
    }
}
