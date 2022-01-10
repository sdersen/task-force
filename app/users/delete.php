<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Deletes user.

if (isset($_POST['delete_user'])) {
    $id = $_POST['delete_user'];

    $statement = $database->prepare('DELETE FROM tasks WHERE user_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $statement = $database->prepare('DELETE FROM lists WHERE user_id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $statement = $database->prepare('DELETE FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    //confirms delete was successfull

    unset($_SESSION['user']);
    $_SESSION['delete_user_confirmation'] = 'Your profile has been deleted.';

    redirect('/');
};
