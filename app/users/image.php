<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';
var_dump($_FILES['upload']);


if (isset($_FILES['upload'])) {
    $upload = $_FILES['upload'];
    $upload['name'] = $_POST['upload'] . '-' . date('Y-m-d-') . $upload['name'];
    $destination = __DIR__ . '/uploads/' . $upload['name'];

    var_dump($upload['type']);

    //Funkar inte alls
    if ($upload['name'] === '') {
        $_SESSION['image_errors'] = [];
        $_SESSION['image_errors'][] = 'Please choose an image';
        // redirect('/profile.php');
    };
    if (!in_array($upload['type'], ['image/jpeg', 'image/png'])) {
        $_SESSION['image_errors'] = [];
        $_SESSION['image_errors'][] = 'Sorry, not a valid file format. Try .png or .jpeg';
        redirect('/profile.php');
    };
    if ($upload['size'] > 16000000) {
        $_SESSION['image_errors'] = [];
        $_SESSION['image_errors'][] = 'Sorry, too big';
        redirect('/profile.php');
    } else {
        move_uploaded_file($upload['tmp_name'], $destination);

        $id = $_SESSION['user']['id'];
        $path = '/app/users/uploads/' . $upload['name'];

        $statement = $database->prepare('UPDATE users SET image = :path WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':path', $path, PDO::PARAM_STR);
        $statement->execute();

        $_SESSION['user']['image'] = $path;

        $_SESSION['confirm'] = 'Upload complete';
        redirect('/profile.php');
    };
};
