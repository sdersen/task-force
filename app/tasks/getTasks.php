<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// if (isset($_SESSION['user']['id'])) {
//     $id = $_SESSION['user']['id'];

//     $statement = $database->query('SELECT * FROM tasks WHERE user_id = :user_id AND completed_at IS NULL;');
//     $statement->bindParam(':user_id', $id, PDO::PARAM_INT);

//     $statement->execute();
//     $tasks = $statement->fetchAll(PDO::FETCH_ASSOC);

//     $_SESSION['tasks'] = [];

//     foreach ($tasks as $task) {
//         array_push(
//             $_SESSION['tasks'],
//             [
//                 'id' => $task['id'],
//                 'title' => $task['title'],
//                 'description' => $task['description'],
//                 'created_at' => $task['created_at'],
//                 'completed_at' => $task['completed_at'],
//                 'user_id' => $task['user_id'],
//                 'list_id' => $task['list_id'],
//                 'deadline_at' => $task['deadline_at']
//             ]
//         );
//     };
//     var_dump($_SESSION['tasks']);
// };
