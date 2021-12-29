<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $name = trim(filter_var($_POST['name']));
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $databaseEmail = checkEmailInDatabase($database, $email);

    if ($email === '' || $name === '') {
        $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'Please enter name and emailadress.';
        redirect('/register.php');
    }
    if ($_POST['password'] === '') {
        $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'You must set a password.';
        redirect('/register.php');
    }
    if (strlen($_POST['password'])  < 6) {
        $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'Your password must be 6 characters or more.';
        redirect('/register.php');
    }
    // Är det ok att filter_validate är här?
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION['errors'][] = 'This is not valid email, please try again.';
        redirect('/register.php');
    }
    if ($databaseEmail) {
        $_SESSION['errors'][] = 'The email is allredy registerd.';
        redirect('/register.php');
    } else {
        $image = 'app/users/uploads/profile-placeholder-img.jpg';

        $statement = $database->prepare('INSERT INTO users (name, email, password, image) VALUES (:name, :email, :password, :image);');
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        // var_dump($user);

        // $_SESSION['user'] = [
        //     'id' => $user['id'],
        //     'name' => $user['name'],
        //     'email' => $user['email'],
        //     'image' => $user['image']
        // ];
        // var_dump($_SESSION['user']);
        redirect('/');
    };
};
