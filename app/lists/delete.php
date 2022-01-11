<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Deletes list but not tasks in the list

$id = $_POST['delete_id'];
$query = 'DELETE FROM lists WHERE id = :id;';
deleteListOrTask($database, $id, $query);

redirect('/lists.php');
