<?php

use App\Core\Database;

class CreateAssessmentTables
{
    public function up(Database $db): void
    {
        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS quizzes (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                course_id BIGINT UNSIGNED NOT NULL,
                title VARCHAR(255) NOT NULL,
                description TEXT NULL,
                passing_score INT NOT NULL DEFAULT 70,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
                INDEX idx_quizzes_course (course_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS quiz_questions (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                quiz_id BIGINT UNSIGNED NOT NULL,
                question_text TEXT NOT NULL,
                question_type VARCHAR(50) NOT NULL DEFAULT 'multiple_choice',
                points INT NOT NULL DEFAULT 1,
                sort_order INT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
                INDEX idx_questions_quiz (quiz_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS quiz_answers (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                question_id BIGINT UNSIGNED NOT NULL,
                answer_text TEXT NOT NULL,
                is_correct TINYINT(1) NOT NULL DEFAULT 0,
                sort_order INT NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL DEFAULT NULL,
                FOREIGN KEY (question_id) REFERENCES quiz_questions(id) ON DELETE CASCADE,
                INDEX idx_answers_question (question_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS quiz_attempts (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                user_id BIGINT UNSIGNED NOT NULL,
                quiz_id BIGINT UNSIGNED NOT NULL,
                started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                completed_at TIMESTAMP NULL DEFAULT NULL,
                score DECIMAL(5,2) NOT NULL DEFAULT 0.00,
                status VARCHAR(30) NOT NULL DEFAULT 'in_progress',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE,
                INDEX idx_attempts_user (user_id),
                INDEX idx_attempts_quiz (quiz_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);

        $db->connection()->exec(<<<SQL
            CREATE TABLE IF NOT EXISTS quiz_results (
                id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                attempt_id BIGINT UNSIGNED NOT NULL,
                question_id BIGINT UNSIGNED NOT NULL,
                selected_answer_id BIGINT UNSIGNED NULL,
                is_correct TINYINT(1) NOT NULL DEFAULT 0,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                FOREIGN KEY (attempt_id) REFERENCES quiz_attempts(id) ON DELETE CASCADE,
                FOREIGN KEY (question_id) REFERENCES quiz_questions(id) ON DELETE CASCADE,
                FOREIGN KEY (selected_answer_id) REFERENCES quiz_answers(id) ON DELETE SET NULL,
                INDEX idx_results_attempt (attempt_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        SQL);
    }

    public function down(Database $db): void
    {
        $db->connection()->exec('DROP TABLE IF EXISTS quiz_results');
        $db->connection()->exec('DROP TABLE IF EXISTS quiz_attempts');
        $db->connection()->exec('DROP TABLE IF EXISTS quiz_answers');
        $db->connection()->exec('DROP TABLE IF EXISTS quiz_questions');
        $db->connection()->exec('DROP TABLE IF EXISTS quizzes');
    }
}
