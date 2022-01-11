<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Adds a list_id to a task.

if (isset($_POST['list'])) {
    // Id for the list
    $list_id = trim($_POST['list']);
    //Id for task
    $id = $_POST['task_id'];

    if ($list_id === 'none') {
        $_SESSION['list_errors'][] = 'You need to create a list before you can ad a task to it.';
        redirect('/tasks.php');
    }

    $statement = $database->prepare(
        'UPDATE tasks SET list_id = :list_id WHERE id = :id'
    );
    $statement->bindParam(':list_id', $list_id, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    redirect('/tasks.php');
};
