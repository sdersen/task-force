<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Deletes list but not tasks in the list

$id = $_POST['delete_id'];

$statement = $database->prepare(
    'DELETE FROM lists WHERE id = :id;'
);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();

//Funkar inte, kolla varför vid tillfälle.
// $lists = 'lists';

// deleteListOrTask($database, $lists, $_POST['delete_id']);

redirect('/lists.php');
