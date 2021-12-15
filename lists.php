<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<h1>Your Lists, woooo</h1>

<section class="create-list-container">

    <form action="app/lists/create.php" method="post">
        <div class="mb-3">
            <label for="title">Title</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="An amazing title" required>
            <small class="form-text">Please enter a title for your list.</small>
        </div>
        <button type="submit" class="btn btn-primary">Create task</button>
    </form>

</section>
<?php require __DIR__ . '/views/footer.php'; ?>
