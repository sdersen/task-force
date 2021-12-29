<?php require __DIR__ . '/app/autoload.php'; ?>
<!-- Tog bort autoload och la denna för att kunna använda tasks -->
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
                    <small class="form-text">Please enter a titl for your task.</small>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <input class="form-control" type="text" name="description" id="description">
                    <small class="form-text">Please provide the your description.</small>
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
            <!-- Kolla på att göra en dropdovn ist. -->
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
                        <h3 class="task-title"><?= htmlspecialchars($task['title']); ?></h3>
                        <!-- EDIT BTNS ---------------------------------------- -->
                        <div class="edit-btn-container">
                            <button class="edit-task-btn"><img class="btn-check-icon btn-icon" src="/assets/images/edit-regular.svg" alt=""></button>
                            <button class="add-list-btn"><img class="btn-tag-icon btn-icon" src="/assets/images/tag-solid.svg" alt=""></button>
                        </div>
                    </div>
                    <p class="task-description"><?= htmlspecialchars($task['description']); ?></p>
                    <span>Deadline: </span><span><?= htmlspecialchars($task['deadline_at']); ?></span><span> </span>
                    <span>Created: </span><span><?= $task['created_at']; ?></span>

                    <?php
                    if ($task['list_id']) : ?>
                        <span>Belongs to list: </span><span><?php echo printListForTask($task['id'], $database) ?></span>
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
                    <div class="list-form hidden">
                        <form class=" " action="app/tasks/addToList.php" method="POST">
                            <label for="list">Add to or change list</label>
                            <div class="flex-container">
                                <select class="form-select form-select-sm select-list-dropdown" name="list" id="list">
                                    <option selected>Choose a list</option>
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
                        <button class="btn btn-success done-task-btn" type="submit">Done</button>
                        <input type="hidden" id="done_id" name="done_id" value="<?= $task['id'] ?>">
                    </form>

                </article>
            <?php endforeach; ?>
        </section>
        <a href="/history.php">Compleated tasks</a>

    <?php endif; ?>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
