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

    $statement = $database->prepare(
        'UPDATE tasks SET title = :title WHERE id = :id'
    );
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
};
if ($description !== '') {
    $description = trim($_POST['description']);
    $id = $_POST['id'];

    $statement = $database->prepare(
        'UPDATE tasks SET description = :description WHERE id = :id'
    );
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
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
    $user = $statement->fetch(PDO::FETCH_ASSOC);
};
redirect('/tasks.php');
