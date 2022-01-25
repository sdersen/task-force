<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_GET['search-task'])) {
    searchPost($database, $_GET['search-task']);
    redirect($_SERVER['HTTP_REFERER']);
}
