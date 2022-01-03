<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Adds a list id to a task.

if (isset($_POST['list'])) {
    // id for the list
    $list_id = trim($_POST['list']);
    //Id for post
    $id = $_POST['task_id'];

    $statement = $database->prepare(
        'UPDATE tasks SET list_id = :list_id WHERE id = :id'
    );
    $statement->bindParam(':list_id', $list_id, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    redirect('/');
};
