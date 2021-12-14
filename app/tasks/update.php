<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/index.php';


$updateCompleate = false;
// Här behöver jag sätta "eller", men den tar inte det.
var_dump($_POST);

if (isset($_POST['new-title'])) {
    $title = trim($_POST['new-title']);
    // HUr får jag in id här??
    //$taskId =
    $description = trim($_POST['new-description']);
    $doneBy = $_POST['new-date'];

    $statement = $database->prepare(
        'UPDATE tasks SET title = :title, description = :description, completed_by = :completed_by'
    );
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':completed_by', $doneBy, PDO::PARAM_STR);
    $statement->bindParam(':task_id', $taskId, PDO::PARAM_INT);


    $statement->execute();
    // $user = $statement->fetch(PDO::FETCH_ASSOC);
    // redirect('/');
};
