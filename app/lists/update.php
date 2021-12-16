<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['title']) || isset($_POST['description']) || isset($_POST['date'])) {
    $title = trim($_POST['title']);
    $id = $_POST['id'];
    $description = trim($_POST['description']);
    $deadline = $_POST['date'];

    $statement = $database->prepare(
        'UPDATE tasks SET title = :title, description = :description, deadline_at = :deadline_at WHERE id = :id'
    );
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':deadline_at', $deadline, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    redirect('/');
};
redirect('/');
