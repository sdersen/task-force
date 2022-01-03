<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
$table = 'tasks';

//Deletes task

deleteListOrTask($database, $table, $_POST['delete_id']);

redirect('/');
