<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<main>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home pageeeee.</p>
    <?php
    if (isset($_SESSION['user'])) : ?>
        <p style="font-weight: bold;"><?php echo 'Welcome ' . htmlspecialchars($_SESSION['user']['name']) . '!'; ?></p>
        <button class="open-create-task-btn">+</button>
        <!-- CREATE TASK------------------------------------- -->
        <section class="create-task-container hidden">
            <form action="app/tasks/create.php" method="post">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title" required>
                    <small class="form-text">Please enter a title for your task.</small>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <input class="form-control" type="text" name="description" id="description">
                    <small class="form-text">Describe your task...</small>
                </div>
                <div class="mb-3">
                    <label for="date">Dedline</label>
                    <input class="form-control" type="date" name="date" id="date">
                    <small class="form-text">Add a deadline</small>
                </div>
                <button type="submit" class="btn btn-primary">Create task</button>
            </form>

        </section>
        <section>
            <h3>Sort by:</h3>
            <form action="app/tasks/sort.php" method="post">
                <label for="Sort">Sort by</label>
                <select class="form-control" name="sort" id="sort">
                    <option class="form-control" value="1">Dedline</option>
                    <option class="form-control" value="2">Created</option>
                    <option class="form-control" value="3">Title</option>
                </select>
                <button type="submit" class="btn btn-primary">Sort</button>
            </form>
            <!-- <form action="app/tasks/sort.php" method="post">
                <input type="hidden" id="poo" name="poo" value="">
                <button type="submit" class="btn btn-primary">created</button>
                <input type="hidden" id="deadline" name="deadline" value="">
                <button type="submit" class="btn btn-primary">Deadline</button>
            </form> -->
        </section>
        <section>
            <?php foreach (getTasks($_SESSION['user']['id'], $database) as $task) : ?>
                <article class="task-container">
                    <div class="headline-container">
                        <h5 class="task-title"><?= htmlspecialchars($task['title']); ?></h5>
                        <!-- EDIT BTNS ---------------------------------------- -->
                        <div class="edit-btn-container">
                            <button class="edit-task-btn" aria-label="Edit task button">
                                <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="edit" class="svg-inline--fa fa-edit fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                    <path fill="currentColor" d="M402.3 344.9l32-32c5-5 13.7-1.5 13.7 5.7V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h273.5c7.1 0 10.7 8.6 5.7 13.7l-32 32c-1.5 1.5-3.5 2.3-5.7 2.3H48v352h352V350.5c0-2.1.8-4.1 2.3-5.6zm156.6-201.8L296.3 405.7l-90.4 10c-26.2 2.9-48.5-19.2-45.6-45.6l10-90.4L432.9 17.1c22.9-22.9 59.9-22.9 82.7 0l43.2 43.2c22.9 22.9 22.9 60 .1 82.8zM460.1 174L402 115.9 216.2 301.8l-7.3 65.3 65.3-7.3L460.1 174zm64.8-79.7l-43.2-43.2c-4.1-4.1-10.8-4.1-14.8 0L436 82l58.1 58.1 30.9-30.9c4-4.2 4-10.8-.1-14.9z"></path>
                                </svg>
                            </button>
                            <button class="add-list-btn" aria-label="Add to list button">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="tag" class="svg-inline--fa fa-tag fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="currentColor" d="M0 252.118V48C0 21.49 21.49 0 48 0h204.118a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882L293.823 497.941c-18.745 18.745-49.137 18.745-67.882 0L14.059 286.059A48 48 0 0 1 0 252.118zM112 64c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="task-description"><?= htmlspecialchars($task['description']); ?></p>
                    <span class="bold-info-text">Deadline: </span><span><?= htmlspecialchars($task['deadline_at']); ?></span><span> </span>
                    <span class="bold-info-text">Created: </span><span><?= $task['created_at']; ?></span>

                    <?php
                    if ($task['list_id']) : ?>
                        <span class="bold-info-text">Belongs to list: </span><span><?php echo printListForTask($task['id'], $database) ?></span>
                    <?php endif; ?>
                    <!-- EDIT CONTAINER -------------------------------------------------------- -->
                    <div class="edit-container hidden">
                        <form action="app/tasks/update.php" method="post">
                            <div class="mb-3">
                                <label for="title">Title</label>
                                <input class="form-control" type="text" name="title" id="title" placeholder="New title for your task">
                                <!-- <small class="form-text">Please enter a title for your task.</small> -->
                            </div>
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <input class="form-control" type="text" name="description" id="description" placeholder="New description for your task">
                                <!-- <small class="form-text">Please provide the your description.</small> -->
                            </div>
                            <div class="mb-3">
                                <label for="date">Dedline</label>
                                <input class="form-control" type="date" name="date" id="date">
                                <!-- <small class="form-text">Add a deadline</small> -->
                            </div>

                            <input type="hidden" id="id" name="id" value="<?= $task['id'] ?>">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <form action="app/tasks/delete.php" method="post">
                            <input type="hidden" id="delete_id" name="delete_id" value="<?= $task['id'] ?>">
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </form>
                    </div>
                    <!-- ADD TO LIST --------------------------------------- -->
                    <div class="list-form hidden">
                        <form class=" " action="app/tasks/addToList.php" method="POST">
                            <label for="list">Add to or change list</label>
                            <div class="flex-container">
                                <select class="form-select form-select-sm select-list-dropdown" name="list" id="list">
                                    <!-- <option selected>Choose a list</option> -->
                                    <?php
                                    foreach (getLists($_SESSION['user']['id'], $database) as $list) : ?>
                                        <option class="form-control" value="<?= $list['id']; ?>"><?= htmlspecialchars($list['title']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" id="task_id" name="task_id" value="<?= $task['id'] ?>">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>
                        </form>
                    </div>
                    <form action="app/tasks/done.php" method="POST">
                        <button class="btn btn-sm btn-outline-success done-task-btn" type="submit">Done</button>
                        <input type="hidden" id="done_id" name="done_id" value="<?= $task['id'] ?>">
                    </form>

                </article>
            <?php endforeach; ?>
        </section>
        <a href="/history.php">Compleated tasks</a>

    <?php endif; ?>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
