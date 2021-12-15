<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// $updateCompleate = false;

if (isset($_POST['title']) || isset($_POST['description']) || isset($_POST['date'])) {
    $title = trim($_POST['title']);
    $id = $_POST['id'];
    $description = trim($_POST['description']);
    $doneBy = $_POST['date'];

    $statement = $database->prepare(
        'UPDATE tasks SET title = :title, description = :description, completed_by = :completed_by WHERE id = :id'
    );
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':completed_by', $doneBy, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    redirect('/');
};
