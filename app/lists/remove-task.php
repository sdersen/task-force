<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// removes a task from a given list

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Indicates where user should be redirected to.
    $redirect = $_POST['redirect'];

    $statement = $database->prepare(
        'UPDATE tasks SET list_id = NULL WHERE id = :id;'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    if ($redirect) {
        redirect('/lists.php');
    }
    redirect('/');
};
