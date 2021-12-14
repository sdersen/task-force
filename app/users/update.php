<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
$updateCompleate = false;

if (isset($_POST['new-email'], $_POST['new-password'])) {
    $email = trim($_POST['new-email']);
    $hashedPassword = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
    $id = $_SESSION['user']['id'];

    //Oklart om denna ska deklareras här?

    // $errors = [];

    // if ($email === '') {
    //     $errors[] = 'The email field is missing.';
    // }

    // if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    //     $errors[] = 'The email is not valid email address.';
    // }

    $statement = $database->prepare('UPDATE users SET email = :email, password = :password WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $updateCompleate = true;
    redirect('/profile.php');
};
