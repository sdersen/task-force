<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $statement = $database->prepare(
        'UPDATE tasks SET list_id = NULL WHERE id = :id;'
    );
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    redirect('/lists.php');
};
