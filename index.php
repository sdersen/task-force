<!-- Tog bort autoload och la denna för att kunna använda tasks -->
<?php require __DIR__ . '/app/tasks/getTasks.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>This is the home page.</p>
    <?php

    if (isset($_SESSION['user'])) : ?>

        <p style="font-weight: bold;"><?php echo 'Welcome ' . htmlspecialchars($_SESSION['user']['name']) . '!'; ?></p>
        <!-- Hämtas bara om jag loggar ut och in efter att bilden laddats upp -->
        <img src="<?php echo $_SESSION['user']['image']; ?>" alt="">
        <section class="create-task-container">

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
                    <input type="date" name="date" id="date">
                    <small class="form-text">Add a deadline</small>
                </div>

                <button type="submit" class="btn btn-primary">Create task</button>
            </form>

        </section>
        <section>
            <?php
            foreach ($tasks as $task) : ?>
                <article class="task-container">
                    <h3 class="task-title"><?= $task['title']; ?></h3>
                    <p class="task-description"><?= $task['description']; ?></p>
                    <span>Deadline</span><span><?= $task['completed_by']; ?></span>
                    <button class="edit_task_btn">Edit</button>
                    <p><?= $task['id']; ?></p>

                    <div class="edit-container hidden">
                        <form action="app/tasks/update.php" method="post">
                            <div class="mb-3">
                                <label for="new-title">Title</label>
                                <input class="form-control" type="text" name="new-title" id="new-title" placeholder="An amazing title">
                                <small class="form-text">Please enter a title for your task.</small>
                            </div>

                            <div class="mb-3">
                                <label for="new-description">Description</label>
                                <input class="form-control" type="text" name="new-description" id="new-description">
                                <small class="form-text">Please provide the your description.</small>
                            </div>

                            <div class="mb-3">
                                <label for="new-date">Dedline</label>
                                <input type="date" name="new-date" id="new-date">
                                <small class="form-text">Add a deadline</small>
                            </div>

                            <button type="submit" class="btn btn-primary">Update task</button>
                        </form>
                    </div>
                </article>
            <?php endforeach; ?>

        </section>

    <?php endif; ?>

</article>

<?php require __DIR__ . '/views/footer.php'; ?>
