<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $statement = $database->prepare('SELECT * FROM users WHERE email =:email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'Sorry, no record of this email';

        redirect('/login.php');
    }
    if (password_verify($_POST['password'], $user['password'])) {
        unset($user['password']);

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'image' => $user['image']
        ];
        redirect('/index.php');
    } elseif ($user['email'] !== $_POST['email'] || password_verify($_POST['password'], $user['password']) === false) {
        $_SESSION['errors'][] = 'Sorry, wrong email or password..';
        redirect('/login.php');
    };
};
