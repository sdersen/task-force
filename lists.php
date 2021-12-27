<?php require __DIR__ . '/app/lists/getLists.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article class="list-page">
    <h1>Your Lists, woooo</h1>

    <section class="create-list-container">

        <form action="app/lists/create.php" method="post">
            <div class="mb-3">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title" required>
                <small class="form-text">Please enter a title for your list.</small>
            </div>
            <button type="submit" class="btn btn-primary">Create list</button>
        </form>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <section>
                <?php
                foreach (getLists($_SESSION['user']['id'], $database) as $list) : ?>
                    <article class="list-container">
                        <h3 class="list-title"><?= htmlspecialchars($list['title']); ?></h3>
                        <span>Created</span><span><?= $list['created_at']; ?></span>
                        <?php foreach (getTasksForList($list['id'], $database) as $task) : ?>
                            <article>
                                <div class="task-container">
                                    <h5 class="task-title"><?= htmlspecialchars($task['title']); ?></h5>
                                    <p class="task-description"><?= htmlspecialchars($task['description']); ?></p>
                                    <span>Deadline</span><span><?= $task['completed_at']; ?></span>

                                    <form action="app/tasks/done.php" method="POST">
                                        <button class="btn btn-primary done-task-btn" type="submit">Task Done</button>
                                        <input type="hidden" id="done_id" name="done_id" value="<?= $task['id'] ?>">
                                    </form>
                                    <form action="app/lists/remove-task.php" method="POST">
                                        <button class="btn btn-primary done-list-btn" type="submit">remove task from list</button>
                                        <input type="hidden" id="id" name="id" value="<?= $task['id'] ?>">
                                    </form>
                                </div>

                            <?php endforeach; ?>

                            </article>
                            <button class="btn btn-primary edit-list-btn">Edit list</button>
                            <form action="app/lists/done.php" method="POST">
                                <button class="btn btn-primary done-list-btn" type="submit">List Done</button>
                                <input type="hidden" id="done_id" name="done_id" value="<?= $list['id'] ?>">
                            </form>


                            <div class="edit-list-container">
                                <form action="app/lists/update.php" method="post">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title">
                                        <small class="form-text">Please enter a title for your task.</small>
                                    </div>

                                    <input type="hidden" id="id" name="id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-primary">Update Title</button>
                                </form>
                                <form action="app/lists/delete.php" method="post">
                                    <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-primary">Delete List</button>
                                </form>
                                <form action="app/lists/delete-list-tasks.php" method="post">
                                    <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-primary">Delete list including tasks</button>
                                </form>
                            </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </section>
</article>
<?php require __DIR__ . '/views/footer.php'; ?>
