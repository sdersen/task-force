<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Creates a task.

if (isset($_POST['title']) || isset($_POST['addToChecklist'])) {
    $title = isset($_POST['title']) ? trim($_POST['title']) : trim($_POST['addToChecklist']); //CHANGED IN ORDER TO REUSE SAME VARIABLES
    $description = isset($_POST['description']) ? trim($_POST['description']) : trim($_POST['addToChecklist']); //CHANGED IN ORDER TO REUSE SAME VARIABLES
    $deadline = $_POST['date'];
    $parentId = $_POST['parent-id'] ?? null; //ADDED IN ORDER TO BE ABLE TO ADD CHECKLIST ITEMS
    //user id
    $id = $_SESSION['user']['id'];
    $createdDate = date("Y-m-d");

    if (strlen($title) > 35) {
        $_SESSION['task_errors'][] = 'Your title must be 35 characters or shorter.';
        redirect('/tasks.php');
    }
    if (strlen($description) > 200) {
        $_SESSION['task_errors'][] = 'Your description must be 200 characters or shorter.';
        redirect('/tasks.php');
    }

    $statement = $database->prepare('INSERT INTO tasks (title, description, created_at, deadline_at, user_id, parent_id)
    VALUES (:title, :description, :created_at, :deadline_at, :user_id, :parent_id);');

    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':deadline_at', $deadline, PDO::PARAM_STR);
    $statement->bindParam(':created_at', $createdDate, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':parent_id', $parentId, PDO::PARAM_INT); //ADDED IN ORDER TO BE ABLE TO ADD CHECKLIST ITEMS

    $statement->execute();

    redirect('/');
};
