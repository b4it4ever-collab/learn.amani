<?php

use App\Core\Database;

class CreateCommunityWishlistTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS community_posts (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                body TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                INDEX idx_posts_user (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS community_comments (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                post_id BIGINT UNSIGNED NOT NULL,
                user_id BIGINT UNSIGNED NOT NULL,
                body TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (post_id) REFERENCES community_posts(id) ON DELETE CASCADE,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                INDEX idx_comments_post (post_id),
                INDEX idx_comments_user (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS wishlist (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                course_id BIGINT UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
                UNIQUE KEY uq_wishlist (user_id, course_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS bookmarks (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                lesson_id BIGINT UNSIGNED NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (lesson_id) REFERENCES lessons(id) ON DELETE CASCADE,
                UNIQUE KEY uq_bookmark (user_id, lesson_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS bookmarks');
        $db->connection()->exec('DROP TABLE IF EXISTS wishlist');
        $db->connection()->exec('DROP TABLE IF EXISTS community_comments');
        $db->connection()->exec('DROP TABLE IF EXISTS community_posts');
    }
}
