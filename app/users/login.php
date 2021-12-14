<?php

declare(strict_types=1);

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// In this file we login users.
//
if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);

    $statement = $database->prepare('SELECT * FROM users WHERE email =:email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user['email'] === $_POST['email'] && password_verify($_POST['password'], $user['password'])) {

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'image' => $user['image']
        ];
        redirect('/index.php');
    } else {
        //funkar ej
        redirect('/login.php');
        echo 'Ups somethiong went wrong...';
    }
};
