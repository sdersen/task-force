<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['password'])) {
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id = $_SESSION['user']['id'];

    if (strlen($_POST['password'])  < 6) {
        $_SESSION['password_errors'] = [];
        $_SESSION['password_errors'][] = 'Your password must be 6 characters or more.';
        redirect('/profile.php');
    } else {
        $statement = $database->prepare('UPDATE users SET password = :password WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $statement->execute();
        // $user = $statement->fetch(PDO::FETCH_ASSOC);
        $_SESSION['password_updated'] = 'Password updated';
        redirect('/profile.php');
    };
};
