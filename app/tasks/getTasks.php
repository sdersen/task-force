<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user']['id'])) {

    $id = $_SESSION['user']['id'];

    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id;');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
}
