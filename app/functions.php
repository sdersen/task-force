<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
};

function getTasks($id, $database)
{
    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NULL;');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
};

function getLists($id, $database)
{
    $statement = $database->query('SELECT * FROM lists WHERE user_id = :user_id;');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $lists;
};
