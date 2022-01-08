<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article class="top-margin">
    <h1>Your lists</h1>
    <p>Create your own list and add tasks as you go along...</p>

    <section>
        <button class="open-create-list-btn">+</button>
        <div class="create-list-container hidden">
            <form action="app/lists/create.php" method="post">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title" required>
                    <small class="form-text">Please enter a title for your list.</small>
                </div>
                <button type="submit" class="btn btn-danger create-list-btn">Create list</button>
            </form>
        </div>
        <?php
        if (isset($_SESSION['user'])) : ?>
            <section>
                <?php
                foreach (getLists($_SESSION['user']['id'], $database) as $list) : ?>
                    <article class="list-container">
                        <div class="headline-container">
                            <h3 class="list-title"><?= htmlspecialchars($list['title']); ?></h3>
                            <button class="edit-list-btn" aria-label="Edit list button">
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="bold-info-text">Created: </span><span><?= $list['created_at']; ?></span>

                        <?php foreach (getTasksForList($list['id'], $database) as $task) : ?>
                            <div class="task-container-in-list">
                                <form class="done-form-list" action="/app/tasks/done.php" method="POST">
                                    <input type="hidden" id="redirect" name="redirect" value="1">
                                    <input type="hidden" id="done_id" name="done_id" value="<?= $task['id'] ?>">
                                    <input class="form-check-input" type="checkbox" name="is_completed" id="is_completed">
                                    <label for="is_completed"><?= htmlspecialchars($task['title']); ?></label>
                                </form>
                                <div class="flex-parent">
                                    <div>

                                    </div>
                                    <div class="date-container-in-list">
                                        <p class="task-in-list-description"><?= htmlspecialchars($task['description']); ?></p>
                                        <span>Deadline: </span><span><?php echo htmlspecialchars($task['deadline_at']); ?></span>
                                    </div>
                                </div>
                                <form action="app/lists/remove-task.php" method="POST">
                                    <button class="btn btn-sm btn-primary remove-task-btn" type="submit">Remove from list</button>
                                    <input type="hidden" id="id" name="id" value="<?= $task['id'] ?>">
                                    <input type="hidden" id="redirect" name="redirect" value="1">
                                </form>
                            </div>
                        <?php endforeach; ?>

                        <form action="app/lists/done.php" method="POST">
                            <button class="btn btn-danger done-list-btn" type="submit">List Done</button>
                            <input type="hidden" id="done_id" name="done_id" value="<?= $list['id'] ?>">
                        </form>

                        <div class="edit-list-container hidden">
                            <form action="app/lists/update.php" method="post">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title">
                                    <small class="form-text">Please enter a title for your list.</small>
                                </div>
                                <input type="hidden" id="id" name="id" value="<?= $list['id'] ?>">
                                <button type="submit" class="btn btn-danger">Update Title</button>
                            </form>
                            <div class="flex-btn-container">
                                <form action="app/lists/delete.php" method="post">
                                    <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-danger">Delete List</button>
                                </form>
                                <form action="app/lists/delete-list-and-tasks.php" method="post">
                                    <input type="hidden" id="delete_id" name="delete_id" value="<?= $list['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger">Delete list incl tasks</button>
                                </form>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </section>
</article>
<?php require __DIR__ . '/views/footer.php'; ?>
