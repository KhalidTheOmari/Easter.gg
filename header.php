
<nav class="navbar fixed-top navbar-expand-sm">
    <a href="Index.php" class="navbar-brand mb-0">
        <img class="d-inline-block align-top" src="Images/Logo.png" alt="OurLogo" width="85px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
            <li class="nav-item"><a class="nav-link" href="Index.php">HOME</a></li>
            <li class="nav-item"><a class="nav-link" href="AddEaster.php">SUBMIT EASTER EGG</a></li>
            <li class="nav-item"><a class="nav-link" href="ManageSubmissions.php">MY CONTRIBUTIONS</a></li>
            <li class="nav-item"><a class="nav-link" href="Index.php#about-us">ABOUT</a></li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <?php if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']): ?>
                <li class="nav-item"><a class="nav-link" href="logout.php?logout=true">LOGOUT</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link btn btn-outline-info px-4" href="login.php">LOGIN</a></li>
                <li class="nav-item"><a class="nav-link btn btn-outline-info px-4" href="SignUp.php">SIGNUP</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
