<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<?php
if (isset($_SESSION['user'])) :
    redirect('/tasks.php');
endif; ?>

<main>
    <?php
    if (isset($_SESSION['confirm'])) : ?>
        <p class="alert alert-success"><?php echo $_SESSION['confirm'] ?></p>
    <?php unset($_SESSION['confirm']);
    endif;
    ?>
    <h1><?php echo $config['title']; ?></h1>
    <p>Organize everything in life whether there is a work-related task or a personal goal, Task Force is here to help you manage all your to-dos.</p>
    <form action="/register.php">
        <button class="btn btn-lg btn-primary register-btn">Register</button>
    </form>
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5 advantage-item">
                <h3>Manage task all your tasks</h3>
                <p>Organize everything in life whether there is a work-related task or a personal goal, Task Force is here to help you manage all your to-dos.</p>
            </div>
            <div class="col-12 col-md-6 advantage-item">
                <img class="advantage-img" src="/assets/images/task.png" alt="">
            </div>
        </div>
        <div class="row second-row">
            <div class="col-12 col-md-5 advantage-item">
                <h3>Get organized with lists</h3>
                <p>Organize everything in life whether there is a work-related task or a personal goal, Task Force is here to help you manage all your to-dos.</p>
            </div>
            <div class="col-12 col-md-6 advantage-item">
                <img class="advantage-img" src="/assets/images/list.png" alt="">
            </div>
        </div>
    </div>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
