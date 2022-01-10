<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

//From Vincent
// define('APP_URL', '/');
// function redirect(string $path)
// {
//     $path = APP_URL . $path .

//         header("Location: ${path}");

//     exit;
// }

//Checks if a user is logged in (if a session has started).
function isUserLoggedIn()
{
    $loggedIn = isset($_SESSION['user']);
    return $loggedIn;
}
// Gets all the tasks from a specific user.
function getTasks($id, $database)
{
    if (isset($_POST['sort'])) {
        $sortId = $_POST['sort'];

        if ($sortId === 'deadline') {
            $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NULL ORDER BY deadline_at;');
            $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
            $statement->execute();
            $tasksByDeadline = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $tasksByDeadline;
        };
        if ($sortId === 'created') {
            $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NULL ORDER BY created_at;');
            $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
            $statement->execute();
            $tasksByCreationDate = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $tasksByCreationDate;
        };
        if ($sortId === 'title') {
            $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NULL ORDER BY title;');
            $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
            $statement->execute();
            $tasksByTitle = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $tasksByTitle;
        };
    };
    if (!isset($_POST['sort'])) {
        $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NULL;');
        $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
        $statement->execute();
        $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $tasks;
    };
}

//Gets all the completed tasks from a specific user.
function getcompletedTasks($id, $database)
{
    $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NOT NULL;');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $tasks;
}
//Get's all the lists from a specific user.
function getLists($id, $database): array
{
    $statement = $database->query('SELECT * FROM lists WHERE user_id = :user_id AND completed_at IS NULL;');
    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $lists = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $lists;
}
//Get's all tasks for a specific list.
function getTasksForList($id, $database): array
{
    $statement = $database->query('SELECT * FROM tasks WHERE list_id = :list_id AND completed_at IS NULL;');
    $statement->bindParam(':list_id', $id, PDO::PARAM_INT);
    $statement->execute();
    $listTasks = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $listTasks;
}
// Prints wich list a task belongs to.
function printListForTask($id, $database)
{
    if ($id) {
        $statement = $database->query('SELECT lists.title from tasks INNER JOIN lists ON tasks.list_id = lists.id WHERE tasks.id = :id;');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $lists = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $lists[0]['title'];
    };
}
// Checks if a user exists by either returning a null variable or the database email.
function checkEmailInDatabase($database, $email) :string
{
    $statement = $database->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $databaseEmail = $statement->fetch(PDO::FETCH_ASSOC);
    return $databaseEmail;
}

//Deletes either list or task.
function deleteListOrTask($database, $id): void
{
    $statement = $database->prepare(
        'DELETE FROM tasks WHERE id = :id;'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    // $statement->bindParam(':table', $table, PDO::PARAM_INT);

    $statement->execute();
}
