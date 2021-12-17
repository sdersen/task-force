<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['email']) || isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id = $_SESSION['user']['id'];
    $databaseEmail = checkEmailInDatabase($database, $email);

    if ($databaseEmail) {
        // Denna funkar, bara inte errors...
        $_SESSION['update_errors'] = [];
        $_SESSION['update_errors'][] = 'The email alredy registerd.';
        redirect('/profile.php');
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION['update_errors'][] = 'Not valid email.';
        redirect('/profile.php');
    } else {
        $statement = $database->prepare('UPDATE users SET email = :email, password = :password WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        redirect('/profile.php');
    };
};
