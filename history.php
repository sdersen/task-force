<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article class="top-margin">
    <h1>History</h1>
    <p>Here you can se all your completed tasks...</p>
</article>
<?php foreach (getcompletedTasks($_SESSION['user']['id'], $database) as $task) : ?>
    <article class="task-container">
        <h3 class="task-title"><?= $task['title']; ?></h3>
        <p class="task-description"><?= $task['description']; ?></p>
        <span>Deadline: </span><span><?= $task['deadline_at']; ?></span>
        <span>Created: </span><span><?= $task['created_at']; ?></span>
        <span>Completed: </span><span><?= $task['completed_at']; ?></span>

        <form action="app/tasks/set-as-uncomplete.php" method="post">
            <input type="hidden" id="id" name="id" value="<?= $task['id'] ?>">
            <button type="submit" class="btn btn-outline-secondary btn-sm">Mark as undone</button>
        </form>
    </article>
<?php endforeach; ?>
<?php require __DIR__ . '/views/footer.php'; ?>
