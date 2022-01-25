<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';


// IF THERE ARE TASKS THAT ARE UNDONE, SET THEM TO DONE
if (isset($_POST['done_tasks'])) {
    $id = $_POST['done_tasks'];
    $doneDate = date("Y-m-d");

    $statement = $database->prepare(
        'UPDATE tasks SET completed_at = :updated WHERE list_id = :id'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':updated', $doneDate, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    redirect($_SERVER['HTTP_REFERER']);
}

// IF THERE ARE TASKS THAT ARE DONE, SET THEM TO UNDONE
if (isset($_POST['undone_tasks'])) {
    $id = $_POST['undone_tasks'];
    $doneDate = null;

    $statement = $database->prepare(
        'UPDATE tasks SET completed_at = :updated WHERE list_id = :id'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':updated', $doneDate, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    redirect($_SERVER['HTTP_REFERER']);
}
