<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$statement = $database->query('SELECT * FROM tasks ORDER BY completed_by;');
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
