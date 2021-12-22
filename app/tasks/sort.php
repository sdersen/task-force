<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['sort'])) {
    $id = $_POST['sort'];
    $testArray = getTasks($_SESSION['user']['id'], $database);
    // var_dump($testArray);

    if ($id == 1) {
        $deadline_array = array_column($testArray, 'deadline_at');
        array_multisort($deadline_array, SORT_DESC, $testArray);
    };
    if ($id == 2) {
        $created_array = array_column($testArray, 'created_at');
        array_multisort($created_array, SORT_ASC, $testArray);
    };
    if ($id == 3) {
        $title_array = array_column($testArray, 'title');
        array_multisort($title_array, SORT_ASC, $testArray);
    };
};
redirect('/');
