<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $name = trim(filter_var($_POST['name']));
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $databaseEmail = checkEmailInDatabase($database, $email);

    if ($email === '') {
        $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'The email field is missing.';
        redirect('/register.php');
    }
    // Är det ok att filter_validate är här?
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION['errors'][] = 'Not valid email.';
        redirect('/register.php');
    }
    if ($databaseEmail) {
        $_SESSION['errors'][] = 'The email alredy registerd.';
        redirect('/register.php');
    } else {
        $image = '/uploads/profile-placeholder-img.jpg';

        $statement = $database->prepare('INSERT INTO users (name, email, password, image) VALUES (:name, :email, :password, :image);');
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        redirect('/');
    };
};
