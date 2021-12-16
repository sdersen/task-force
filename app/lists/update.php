<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['title'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $id = $_POST['id'];

    $statement = $database->prepare(
        'UPDATE lists SET title = :title WHERE id = :id'
    );
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    $statement->execute();
    // $user = $statement->fetch(PDO::FETCH_ASSOC);
    redirect('/lists.php');
};
