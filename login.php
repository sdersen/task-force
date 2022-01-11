<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>


<article class="top-margin">
    <h1>Login</h1>
    <form action="app/users/login.php" method="post">
        <?php if (isset($_SESSION['errors'])) : ?>
            <?php foreach ($_SESSION['errors'] as $error) : ?>
                <p class="alert alert-danger"><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']); ?>
        <?php endif; ?>
        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="name@mail.com" required>
            <small class="form-text">Please provide your email address.</small>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" id="password" required>
            <small class="form-text">Please provide your password (passphrase).</small>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
