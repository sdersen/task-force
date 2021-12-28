    <!-- BOOTSTRAP -->
    <nav class="navbar navbar-expand-md navbar-light hidden">
        <div>
            <img class="nav-logo" src="/assets/images/check-double-solid.svg" alt="">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about.php">About</a>
                </li>
                <?php if (isUserLoggedIn() !== true) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login.php">Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register.php">Register </a>
                    </li>
                <?php endif; ?>

                <?php if (isUserLoggedIn()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/lists.php">Your lists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/app/users/logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <!-- Hämtas bara om jag loggar ut och in efter att bilden laddats upp -->
                        <img class="profile-img-nav" src="<?php echo $_SESSION['user']['image']; ?>" alt="">
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg navbar-light hidden">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"> <img class="nav-logo" src="/assets/images/check-double-solid.svg" alt="">
            </a>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/about.php">About</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- KORREKTA -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid ">
            <a class="navbar-brand" href="#"> <img class="nav-logo" src="/assets/images/check-double-solid.svg" alt="">
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
                    <?php if (isUserLoggedIn() !== true) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login.php">Login </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register.php">Register </a>
                        </li>
                    <?php endif; ?>

                    <?php if (isUserLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/lists.php">Your lists</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/app/users/logout.php">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <!-- Hämtas bara om jag loggar ut och in efter att bilden laddats upp -->
                            <img class="profile-img-nav" src="<?php echo $_SESSION['user']['image']; ?>" alt="">
                        </li>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
