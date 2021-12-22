<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['upload'])) {
    $upload = $_FILES['upload'];
    $upload['name'] = $_POST['upload'] . '-' . date('Y-m-d-') . $upload['name'];
    $destination = __DIR__ . '/uploads/' . $upload['name'];

    if ($upload['name'] === '') {
        $_SESSION['image_errors'] = [];
        $_SESSION['image_errors'][] = 'Please choose an image';
        redirect('/profile.php');
    };
    //Det printar sorry wrong format ALLTID, varför?
    if ($upload['type'] !== ['image/jpeg', 'image/png']) {
        $_SESSION['image_errors'] = [];
        $_SESSION['image_errors'][] = 'Sorry, not a valid file format. Try .png .jpg or .jpeg';
        // redirect('/profile.php');
    };
    if ($upload['size'] > 16000000) {
        $_SESSION['image_errors'][] = 'Sorry, to big';
        // redirect('/profile.php');
    } else {
        move_uploaded_file($upload['tmp_name'], $destination);

        $id = $_SESSION['user']['id'];

        $path = '/app/users/uploads/' . $upload['name'];

        $statement = $database->prepare('UPDATE users SET image = :path WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':path', $path, PDO::PARAM_STR);
        $statement->execute();

        $_SESSION['user']['image'] = $path;
        redirect('/profile.php');
    };
};
