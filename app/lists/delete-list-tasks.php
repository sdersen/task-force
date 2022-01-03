<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Deletes a list and all its tasks.

$id = $_POST['delete_id'];

$statement = $database->prepare(
    'DELETE FROM lists WHERE id = :id;'
);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

$statement = $database->prepare(
    'DELETE FROM tasks WHERE list_id = :list_id;'
);
$statement->bindParam(':list_id', $id, PDO::PARAM_INT);
$statement->execute();

redirect('/lists.php');
