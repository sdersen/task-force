<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Marks list and all its tasks as done.

$id = $_POST['done_id'];
$doneDate = date("Y-m-d");

$queryList = 'UPDATE lists SET completed_at = :date WHERE id = :id;';
$bindList = ':id';

$queryTask = 'UPDATE tasks SET completed_at = :date WHERE list_id = :list_id;';
$bindTask = ':list_id';

// Marks list as done.
SetListOrTaskDone($database, $id, $doneDate, $queryList, $bindList);

// Marks tasks of given list as done.
SetListOrTaskDone($database, $id, $doneDate, $queryTask, $bindTask);

redirect('/lists.php');
