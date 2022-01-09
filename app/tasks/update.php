<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Updates a task title, descriprion OR deadline
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];

//Checks if title, decsription or date is set.
if ($title !== '') {
    $title = trim($_POST['title']);
    //task_id passed as hidden
    $id = $_POST['id'];

    if (strlen($title) > 35) {
        $_SESSION['update_task_errors'][] = 'Your title must be 35 characters or shorter.';
        redirect('/tasks.php');
    }
    $statement = $database->prepare(
        'UPDATE tasks SET title = :title WHERE id = :id'
    );
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
};
if ($description !== '') {
    $description = trim($_POST['description']);
    $id = $_POST['id'];

    if (strlen($description) > 200) {
        $_SESSION['update_task_errors'][] = 'Your description must be 200 characters or shorter.';
        redirect('/tasks.php');
    }

    $statement = $database->prepare(
        'UPDATE tasks SET description = :description WHERE id = :id'
    );
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
};
if ($date !== '') {
    $deadline = $_POST['date'];
    $id = $_POST['id'];

    $statement = $database->prepare(
        'UPDATE tasks SET deadline_at = :deadline_at WHERE id = :id'
    );

    $statement->bindParam(':deadline_at', $deadline, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
};
redirect('/tasks.php');
