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
    $statement = $database->query('SELECT * FROM lists WHERE user_id = :user_id AND completed_at IS NULL;');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $lists;
};
function getTasksForList($id, $database)
{
    $statement = $database->query('SELECT * FROM tasks WHERE list_id = :list_id AND completed_at IS NULL;');
    $statement->bindParam(':list_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $listTasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $listTasks;
};

function checkEmailInDatabase($database, $email)
{
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $databaseEmail = $statement->fetch(PDO::FETCH_ASSOC);
    return $databaseEmail;
};

function deleteListOrTask($database, $table, $id)
{
    $statement = $database->prepare(
        'DELETE FROM :table WHERE id = :id;'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':table', $table, PDO::PARAM_INT);

    $statement->execute();
}
