<!-- La in update istf autoload här för att nå update variabeln $updateCompleate -->
<?php require __DIR__ . '/app/users/update.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<!-- Behöver ett meddelande att uppdatering lyckats... -->

<span>Name</span>
<p><?= $_SESSION['user']['name'] ?></p>

<span>Email</span>
<p><?= $_SESSION['user']['email'] ?></p>

<button class="update-profile-btn">Update profile</button>
<?php
if (isset($_SESSION['update_errors'])) :
    foreach ($_SESSION['update_errors'] as $error) : ?>
        <p><?= $error ?></p>
<?php endforeach;
    unset($_SESSION['update_errors']);
endif;
?>
<article class="update-profile-container hidden">
    <h3>Upate information</h3>

    <form action="app/users/update.php" method="post">
        <div class="mb-3">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" placeholder="New email" required>
            <small class="form-text">Please provide your new email address.</small>
        </div>

        <div class="mb-3">
            <label for="new-password">Password</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="New password" required>
            <small class="form-text">Please provide your new password (passphrase). Min X characters.</small>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</article>

<form action="app/users/image.php" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="upload">Upload profile image</label>
        <input class="form-control" type="file" accept="image/png, image/jpeg, image/jpg" name="upload" id="upload">
        <small class="form-text">Choose your image.</small>
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>
</form>

<?php require __DIR__ . '/views/footer.php'; ?>
