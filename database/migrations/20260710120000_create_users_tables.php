<?php

use App\Core\Database;

class CreateUsersTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS roles (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL UNIQUE,
                display_name VARCHAR(150) NULL,
                description TEXT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS permissions (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150) NOT NULL UNIQUE,
                display_name VARCHAR(180) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS role_permissions (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                role_id BIGINT UNSIGNED NOT NULL,
                permission_id BIGINT UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
                FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
                UNIQUE KEY uq_role_permission (role_id, permission_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS users (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                first_name VARCHAR(100) NULL,
                last_name VARCHAR(100) NULL,
                email VARCHAR(255) NOT NULL UNIQUE,
                password_hash VARCHAR(255) NOT NULL,
                avatar_url VARCHAR(500) NULL,
                phone VARCHAR(30) NULL,
                bio TEXT NULL,
                status VARCHAR(30) NOT NULL DEFAULT 'active',
                last_login_at TIMESTAMP NULL DEFAULT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                INDEX idx_users_email (email),
                INDEX idx_users_status (status)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS user_roles (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                role_id BIGINT UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
                UNIQUE KEY uq_user_role (user_id, role_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS user_roles');
        $db->connection()->exec('DROP TABLE IF EXISTS role_permissions');
        $db->connection()->exec('DROP TABLE IF EXISTS users');
        $db->connection()->exec('DROP TABLE IF EXISTS permissions');
        $db->connection()->exec('DROP TABLE IF EXISTS roles');
    }
}
