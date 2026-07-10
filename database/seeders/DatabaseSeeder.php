<?php

use App\Core\Database;

class DatabaseSeeder
{
    public function run(Database $db): void
    {
        $db->connection()->exec("INSERT INTO roles (name, display_name, description) VALUES
            ('admin', 'Administrator', 'Platform administrator'),
            ('student', 'Student', 'Learner account')
        ON DUPLICATE KEY UPDATE name = VALUES(name)");

        $db->connection()->exec("INSERT INTO permissions (name, display_name) VALUES
            ('manage_users', 'Manage Users'),
            ('manage_courses', 'Manage Courses'),
            ('manage_content', 'Manage Content'),
            ('enroll_courses', 'Enroll in Courses')
        ON DUPLICATE KEY UPDATE name = VALUES(name)");

        $adminRoleId = $db->connection()->query("SELECT id FROM roles WHERE name = 'admin'")->fetchColumn();
        $studentRoleId = $db->connection()->query("SELECT id FROM roles WHERE name = 'student'")->fetchColumn();
        $manageUsersId = $db->connection()->query("SELECT id FROM permissions WHERE name = 'manage_users'")->fetchColumn();
        $manageCoursesId = $db->connection()->query("SELECT id FROM permissions WHERE name = 'manage_courses'")->fetchColumn();
        $manageContentId = $db->connection()->query("SELECT id FROM permissions WHERE name = 'manage_content'")->fetchColumn();
        $enrollCoursesId = $db->connection()->query("SELECT id FROM permissions WHERE name = 'enroll_courses'")->fetchColumn();

        $db->connection()->exec("INSERT INTO role_permissions (role_id, permission_id) VALUES
            ($adminRoleId, $manageUsersId),
            ($adminRoleId, $manageCoursesId),
            ($adminRoleId, $manageContentId),
            ($studentRoleId, $enrollCoursesId)
        ON DUPLICATE KEY UPDATE role_id = VALUES(role_id)");

        $adminPassword = password_hash('Admin@2026!', PASSWORD_BCRYPT);
        $studentPassword = password_hash('Student@2026!', PASSWORD_BCRYPT);

        $db->connection()->exec("INSERT INTO users (first_name, last_name, email, password_hash, status) VALUES
            ('System', 'Admin', 'admin@learnamani.com', '$adminPassword', 'active'),
            ('Sample', 'Student', 'student@learnamani.com', '$studentPassword', 'active')
        ON DUPLICATE KEY UPDATE email = VALUES(email)");

        $adminUserId = $db->connection()->query("SELECT id FROM users WHERE email = 'admin@learnamani.com'")->fetchColumn();
        $studentUserId = $db->connection()->query("SELECT id FROM users WHERE email = 'student@learnamani.com'")->fetchColumn();

        $db->connection()->exec("INSERT INTO user_roles (user_id, role_id) VALUES
            ($adminUserId, $adminRoleId),
            ($studentUserId, $studentRoleId)
        ON DUPLICATE KEY UPDATE role_id = VALUES(role_id)");

        $categorySeeds = [
            ['Agriculture', 'agriculture', 'Modern agricultural practices and agri-tech.', 'bi bi-flower2', '#16a34a'],
            ['Technology', 'technology', 'Skills for modern digital work and innovation.', 'bi bi-cpu', '#4f46e5'],
            ['Business', 'business', 'Leadership, management, and growth strategies.', 'bi bi-briefcase', '#f59e0b'],
            ['Poultry', 'poultry', 'Poultry management and healthy farm practices.', 'bi bi-basket3', '#0f766e'],
            ['Crocheting', 'crocheting', 'Creative crafting and textile techniques.', 'bi bi-scissors', '#db2777'],
            ['English', 'english', 'Communication and language confidence for global work.', 'bi bi-translate', '#2563eb'],
        ];

        foreach ($categorySeeds as $seed) {
            $db->connection()->prepare("INSERT INTO categories (name, slug, description, icon, color) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE name = VALUES(name)")->execute($seed);
        }

        $courseSeeds = [
            ['Agriculture Training', 'agriculture-training', 'Learn the foundations of modern agriculture.', 1, $adminUserId, 0, 'beginner', 'published'],
            ['Technology Skills', 'technology-skills', 'Build practical digital and technology competencies.', 2, $adminUserId, 1, 'intermediate', 'published'],
            ['Business Management', 'business-management', 'Strengthen strategic thinking and business execution.', 3, $adminUserId, 1, 'intermediate', 'published'],
            ['Poultry Expertise', 'poultry-expertise', 'Master modern poultry operations with confidence.', 4, $adminUserId, 0, 'beginner', 'published'],
            ['Crocheting', 'crocheting', 'Create beautiful handmade pieces with step-by-step guidance.', 5, $adminUserId, 0, 'beginner', 'published'],
            ['English Course', 'english-course', 'Build professional communication and language confidence.', 6, $adminUserId, 0, 'beginner', 'published'],
        ];

        foreach ($courseSeeds as $seed) {
            $stmt = $db->connection()->prepare("INSERT INTO courses (title, slug, short_description, category_id, instructor_id, featured, difficulty, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE title = VALUES(title)");
            $stmt->execute($seed);
        }

        $courseIds = $db->connection()->query("SELECT id FROM courses ORDER BY id")->fetchAll(PDO::FETCH_COLUMN);
        foreach ($courseIds as $courseId) {
            for ($sectionIndex = 1; $sectionIndex <= 3; $sectionIndex++) {
                $sectionStmt = $db->connection()->prepare("INSERT INTO course_sections (course_id, title, description, sort_order) VALUES (?, ?, ?, ?)");
                $sectionStmt->execute([$courseId, 'Section ' . $sectionIndex, 'Structured learning content for this course.', $sectionIndex]);
                $sectionId = (int) $db->connection()->lastInsertId();

                for ($lessonIndex = 1; $lessonIndex <= 5; $lessonIndex++) {
                    $lessonStmt = $db->connection()->prepare("INSERT INTO lessons (section_id, title, description, content_placeholder, duration_minutes, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
                    $lessonStmt->execute([$sectionId, 'Lesson ' . $lessonIndex, 'Practical lesson content for this section.', 'Content placeholder for lesson ' . $lessonIndex, 15 + $lessonIndex, $lessonIndex]);
                }
            }
        }

        $db->connection()->exec("INSERT INTO certificate_templates (name, subject, body_template) VALUES
            ('Completion', 'Certificate of Completion', 'Congratulations on completing the course!')
        ON DUPLICATE KEY UPDATE name = VALUES(name)");

        $db->connection()->exec("INSERT INTO settings (key_name, value_text) VALUES
            ('site_name', 'Learn.Amani'),
            ('default_currency', 'USD')
        ON DUPLICATE KEY UPDATE key_name = VALUES(key_name)");
    }
}
