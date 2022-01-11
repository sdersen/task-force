<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Deletes a list and all its tasks.

if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $queryList = 'DELETE FROM lists WHERE id = :id;';

    deleteListOrTask($database, $id, $queryList);

    $statement = $database->prepare(
        'DELETE FROM tasks WHERE list_id = :list_id;'
    );
    $statement->bindParam(':list_id', $id, PDO::PARAM_INT);
    $statement->execute();

    redirect('/lists.php');
}
