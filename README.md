# Learn.Amani

Learn.Amani is a production-ready Learning Management System foundation built with PHP 8.2, MySQL, Composer PSR-4 autoloading, and a lightweight MVC framework.

## Architecture

- MVC structure under app/Controllers, app/Models, and app/Views
- Core framework components in app/Core
- Middleware support in app/Middleware
- Routing and bootstrapping in routes/ and index.php
- Secure request, session, validation, and CSRF handling included

## Getting Started

1. Install dependencies:
   - composer install
2. Configure your database settings in config/database.php or environment variables.
3. Serve the application from the public directory.

## Notes

This repository currently contains the foundational structure and framework layer only. Application pages and domain-specific modules can be added on top of this base.
