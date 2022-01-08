<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Sets an allredy done-task as uncomplete and brings it back to the other tasks.

$id = $_POST['id'];

$statement = $database->prepare(
    'UPDATE tasks SET completed_at = NULL WHERE id = :id'
);
$statement->bindParam(':id', $id, PDO::PARAM_INT);

$statement->execute();
redirect('/');
