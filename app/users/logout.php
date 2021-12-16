<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
};
if (isset($_SESSION['tasks'])) {
    unset($_SESSION['tasks']);
};

// session_destroy();

redirect('/index.php');
