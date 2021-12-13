<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $name = trim($_POST['name']);
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //Oklart om denna ska deklareras här?

    // $errors = [];

    // if ($email === '') {
    //     $errors[] = 'The email field is missing.';
    // }

    // if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    //     $errors[] = 'The email is not valid email address.';
    // }

    $statement = $database->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password);');
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // Här behöver jag komma på hur man går direkt till inloggat läga och skapa session
    // if ($user['email'] === $email && password_verify($hashedPassword, $user['password'])) {

    //     $_SESSION['user'] = [
    //         'id' => $user['id'],
    //         'name' => $user['name'],
    //         'email' => $user['email']
    //     ];
    //     redirect('/index.php');
    // } else {
    //     redirect('/login.php');
    // }
};

redirect('/');
