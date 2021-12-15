<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['upload'])) {
    $upload = $_FILES['upload'];

    $upload['name'] = date('Y-m-d-') . $upload['name'];
    $direction = __DIR__ . '/uploads/' . $upload['name'];

    //Det printar sorry wrong format, varför?
    if ($upload['type'] !== 'image/png' || 'image/jpeg' || 'image/jpg') {
        echo 'Sorry wrong format';
    };
    if ($upload['size'] > 16000000) {
        echo 'The file is to big.';
    } else {
        move_uploaded_file($upload['tmp_name'], $direction);

        $id = $_SESSION['user']['id'];
        $path = '/app/users/uploads/' . $upload['name'];
        // var_dump($id);

        $statement = $database->prepare('UPDATE users SET image = :path WHERE id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->bindParam(':path', $path, PDO::PARAM_STR);

        $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);


        // redirect('/profile.php');

    };
};
