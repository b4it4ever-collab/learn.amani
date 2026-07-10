<?php

require __DIR__ . '/../../vendor/autoload.php';

$config = require __DIR__ . '/../../config/database.php';
$db = new App\Core\Database($config);
$seeder = new DatabaseSeeder();
$seeder->run($db);

echo "Database seeded successfully.\n";
