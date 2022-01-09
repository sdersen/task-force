<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//updatdes user password

if (isset($_POST['password'])) {
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id = $_SESSION['user']['id'];

    //checks that password has 6 or more characters
    if (strlen($_POST['password'])  < 12) {
        $_SESSION['password_errors'][] = 'Your password must be 12 characters or more.';
        redirect('/profile.php');
    } else {
        $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $statement->execute();
        // informs user that change is made.

        $_SESSION['password_updated'] = 'Password updated';
        redirect('/profile.php');
    };
};
