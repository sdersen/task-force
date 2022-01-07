<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//A user login

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);

    $statement = $database->prepare('SELECT * FROM users WHERE email =:email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    //If the email dosent exist
    // $email = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'][] = 'Sorry, not a valid emailadress';

        redirect('/login.php');
    }
    if (!$user) {
        // $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'Sorry, no record of this email';

        redirect('/login.php');
    }
    // Checks if user email and password match
    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'image' => $user['image']
        ];
        redirect('/tasks.php');
    } elseif ($user['email'] !== $_POST['email'] || password_verify($_POST['password'], $user['password']) === false) {
        $_SESSION['errors'][] = 'Sorry, wrong email or password..';
        redirect('/login.php');
    };
};
