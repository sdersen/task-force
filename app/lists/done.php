<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = $_POST['done_id'];
$doneDate = date("Y-m-d");

$statement = $database->prepare(
    'UPDATE lists SET completed_at = :date WHERE id = :id;'
);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->bindParam(':date', $doneDate, PDO::PARAM_STR);
$statement->execute();

$statement = $database->prepare(
    'UPDATE tasks SET completed_at = :date WHERE list_id = :list_id;'
);
$statement->bindParam(':list_id', $id, PDO::PARAM_INT);
$statement->bindParam(':date', $doneDate, PDO::PARAM_STR);
$statement->execute();

redirect('/lists.php');
