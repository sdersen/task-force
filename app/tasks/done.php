<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Marks a task as done by adding a "completed_at" date


if (isset($_POST['done_id'])) {
    // $redirect = $_POST['redirect'];    // An int that indicates where the user should be redirected to
    $id = $_POST['done_id'];
    $doneDate = date("Y-m-d");

    if (isset($_POST['is_completed'])) {
        $query = 'UPDATE tasks SET completed_at = :date WHERE id = :id';

        $bindTask = ':id';
        SetListOrTaskDone($database, $id, $doneDate, $query, $bindTask);
    } else {
        $query = 'UPDATE tasks SET completed_at = NULL WHERE id = :id';

        $bindTask = ':id';
        SetListOrTaskUndone($database, $id, $query, $bindTask);
    }


    $_SESSION['task_done_confirm'][] = 'Task complete!';

    // indicates where the user should be redirected to
    if ($redirect) {
        redirect('/tasks.php');
    }
    redirect('/');
}
