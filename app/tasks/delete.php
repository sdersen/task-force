<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Deletes task
$query = 'DELETE FROM tasks WHERE id = :id;';

deleteListOrTask($database, $_POST['delete_id'], $query);

redirect('/');
