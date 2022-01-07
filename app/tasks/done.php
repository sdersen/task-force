<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Marks a task as done by adding a "completed_at" date

if (isset($_POST['done_id'])) {
    // int that indicates where the user should be rederected to
    $redirect = $_POST['redirect'];
    $id = $_POST['done_id'];
    $doneDate = date("Y-m-d");

    $statement = $database->prepare(
        'UPDATE tasks SET completed_at = :date WHERE id = :id'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':date', $doneDate, PDO::PARAM_STR);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // indicates where the user should be rederected to
    if ($redirect) {
        redirect('/lists.php');
    }

    redirect('/');
}
