<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

//Updated user email.

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $id = $_SESSION['user']['id'];
    //Checks if email exists in database
    $databaseEmail = checkEmailInDatabase($database, $email);

    //Checks if email allredy exists in database
    if ($databaseEmail) {
        // $_SESSION['update_errors'] = [];
        $_SESSION['update_errors'][] = 'The email is alredy registerd.';
        redirect('/profile.php');
    }
    //checks if email is a valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $_SESSION['update_errors'][] = 'Please enter a valid email.';
        redirect('/profile.php');
    } else {
        $statement = $database->prepare('UPDATE users SET email = :email WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);

        $statement->execute();
        $_SESSION['user']['email'] = $email;

        //confirms update was successfull
        $_SESSION['confirm'] = 'Email updated!';
        redirect('/profile.php');
    };
};
