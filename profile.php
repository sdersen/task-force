<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php'; ?>

<article class="top-margin">
    <img class="profile-img-profile" src="<?php echo $_SESSION['user']['image']; ?>" alt="<?php echo $_SESSION['user']['name']; ?>">
    <br>
    <span>Name:</span>
    <p><?= $_SESSION['user']['name'] ?></p>

    <span>Email:</span>
    <p><?= $_SESSION['user']['email'] ?></p>
    <?php if (isset($_SESSION['update_errors'])) : ?>
        <?php foreach ($_SESSION['update_errors'] as $error) : ?>
            <p class="alert alert-danger"><?= $error ?></p>
        <?php endforeach; ?>
        <?php unset($_SESSION['update_errors']); ?>
    <?php endif; ?>
    <?php if (isset($_SESSION['confirm'])) : ?>
        <p class="alert alert-success"><?php echo $_SESSION['confirm'] ?></p>
        <?php unset($_SESSION['confirm']); ?>
    <?php endif; ?>
    <article class="update-profile-container ">
        <h3>Update information</h3>

        <form action="app/users/update-email.php" method="post">
            <div class="mb-3">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="New email">
                <small class="form-text">Please provide your new email address.</small>
            </div>
            <button type="submit" class="btn btn-secondary">Update email</button>
        </form>
        <?php if (isset($_SESSION['password_errors'])) : ?>
            <?php foreach ($_SESSION['password_errors'] as $error) : ?>
                <p class="alert alert-danger"><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['password_errors']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['password_updated'])) : ?>
            <p class="alert alert-success"><?php echo $_SESSION['password_updated'] ?></p>
            <?php unset($_SESSION['password_updated']); ?>
        <?php endif; ?>
        <form action="app/users/update-password.php" method="post">
            <div class="mb-3">
                <label for="new-password">Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="New password">
                <small class="form-text">Please provide your new password (passphrase). Min 16 characters.</small>
            </div>
            <button type="submit" class="btn btn-secondary">Update password</button>
        </form>
    </article>
    <form action="app/users/image.php" method="post" enctype="multipart/form-data">
        <?php if (isset($_SESSION['image_errors'])) : ?>
            <?php foreach ($_SESSION['image_errors'] as $error) : ?>
                <p class="alert alert-danger"><?= $error ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['image_errors']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['confirm'])) : ?>
            <p class="alert alert-success"><?php echo $_SESSION['confirm'] ?></p>
            <?php unset($_SESSION['confirm']); ?>
        <?php endif; ?>
        <div class="mb-3">
            <label class="form-label" for="upload">Upload profile image</label>
            <input class="form-control" type="file" accept=".png, .jpeg" name="upload" id="upload">
            <input type="hidden" id="hidden_upload" name="hidden_upload" value="<?= $_SESSION['user']['id'] ?>">
            <small class="form-text">Choose your image.</small>
        </div>
        <button type="submit" class="btn btn-secondary">Upload</button>
    </form>
    <br>
    <form action="app/users/delete.php" method="post">
        <input type="hidden" id="delete_user" name="delete_user" value="<?= $_SESSION['user']['id'] ?>">
        <button type="submit" class="btn btn-outline-danger">Delete entire profile</button>
    </form>
</article>

<?php require __DIR__ . '/views/footer.php'; ?>
