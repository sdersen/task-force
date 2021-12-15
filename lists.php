<?php require __DIR__ . '/app/lists/getLists.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

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
        <p style="font-weight: bold;">Your lists</p>
        <!-- Hämtas bara om jag loggar ut och in efter att bilden laddats upp -->
        <section>
            <?php
            foreach ($lists as $list) : ?>
                <article class="list-container">
                    <h3 class="list-title"><?= $list['title']; ?></h3>
                    <span>Created</span><span><?= $list['created_at']; ?></span>

                    <button class="edit_list_btn">Edit</button>
                    <form action="app/list/done.php">
                        <button>Done</button>
                    </form>

                </article>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</section>
<?php require __DIR__ . '/views/footer.php'; ?>
