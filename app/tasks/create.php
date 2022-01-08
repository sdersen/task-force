<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Creates a task.

if (isset($_POST['title'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $deadline = $_POST['date'];
    //user id
    $id = $_SESSION['user']['id'];
    $createdDate = date("Y-m-d");

    $statement = $database->prepare('INSERT INTO tasks (title, description, created_at, deadline_at, user_id)
    VALUES (:title, :description, :created_at, :deadline_at, :user_id);');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':deadline_at', $deadline, PDO::PARAM_STR);
    $statement->bindParam(':created_at', $createdDate, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

    $statement->execute();

    redirect('/');
};
