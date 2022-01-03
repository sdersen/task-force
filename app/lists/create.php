<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
// Creates a new list to the db

if (isset($_POST['title'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $id = $_SESSION['user']['id'];
    $createdDate = date("Y-m-d");

    $statement = $database->prepare('INSERT INTO lists (title, created_at, user_id)
    VALUES (:title, :created_at, :user_id);');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':created_at', $createdDate, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    redirect('/lists.php');
};
