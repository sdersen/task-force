<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['name'], $_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $name = trim(filter_var($_POST['name']));
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);

    //checks if user allredy exists
    $databaseEmail = checkEmailInDatabase($database, $email);

    // If email or name is not set
    if ($email === '' || $name === '') {
        // $_SESSION['errors'] = [];
        $_SESSION['errors'][] = 'Please enter name and emailadress.';
        redirect('/register.php');
    }
    //If password if not given
    if ($_POST['password'] === '') {
        $_SESSION['errors'][] = 'You must set a password.';
        redirect('/register.php');
    }
    //If password is not 6 characters or more
    if (strlen($_POST['password'])  < 12) {
        $_SESSION['errors'][] = 'Your password must be 12 characters or more.';
        redirect('/register.php');
    }
    // Checks for valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION['errors'][] = 'This is not valid email, please try again.';
        redirect('/register.php');
    }
    //Checks if user allredy exists
    if ($databaseEmail) {
        $_SESSION['errors'][] = 'The email is allredy registerd.';
        redirect('/register.php');
    } else {
        // Gives that new user a default profile-image
        $image = '/uploads/profile-placeholder-img.jpg';

        $statement = $database->prepare('INSERT INTO users (name, email, password, image) VALUES (:name, :email, :password, :image);');
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        //Lets the user know that th e registration was successfull
        $_SESSION['confirm'] = 'Registry successfull, you can now login!';
        redirect('/');
    };
};
