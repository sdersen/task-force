    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#"> <img class="nav-logo" src="/assets/images/task_logo.png" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav align-items-center">

                    <li class="nav-item">
                        <a class="nav-link" href="/index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/about.php">About</a>
                    </li>
                    <?php if (!isUserLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/register.php">Register </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/login.php">Login </a>
                        </li>
                    <?php endif; ?>

                    <?php if (isUserLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/lists.php">Your lists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile.php">Profile</a>
                        </li>
                        <li class="nav-item logout">
                            <a class="nav-link " href="/app/users/logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <img class="profile-img-nav" src="<?php echo $_SESSION['user']['image']; ?>" alt="">
                        </li>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
