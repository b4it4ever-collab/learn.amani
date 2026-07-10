# Learn.Amani Database Architecture

## Overview
This database layer is designed for a commercial Learning Management System with support for users, roles, permissions, courses, lessons, assessments, certificates, community activity, and learner progress.

## Engine
- MySQL
- InnoDB
- utf8mb4
- Foreign keys and indexes enabled
- Timestamp columns included for auditing
- Soft delete support on applicable tables

## Core Entities
- Users and authorization: users, roles, permissions, role_permissions, user_roles
- Learning content: categories, courses, course_sections, lessons, lesson_resources, tags, course_tags
- Progress and engagement: lesson_progress, course_progress, enrollments, course_reviews, wishlist, bookmarks
- Assessments: quizzes, quiz_questions, quiz_answers, quiz_attempts, quiz_results
- Certifications and communication: certificates, certificate_templates, notifications, messages
- Community and platform: community_posts, community_comments, settings, activity_logs

## Seeded Data
- 6 categories
- 6 sample courses
- 3 sections per course
- 5 lessons per section
- Admin user: admin@learnamani.com
- Student user: student@learnamani.com

## Sample Credentials
- Admin: admin@learnamani.com / Admin@2026!
- Student: student@learnamani.com / Student@2026!
