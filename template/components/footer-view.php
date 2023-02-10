<nav class="container-fluid d-flex justify-content-center color-main p-2 fixed-bottom">
    <div class="row gap-2">
        <div class="col">
            <a href="index.php">
                <img src="../public/assets/img/home.png" alt="homepage" class="nav-icon">
            </a>
        </div>
        <div class="col">
            <a href="explore.php">
                <img src="../public/assets/img/explore.png" alt="explore" class="nav-icon">
            </a>
        </div>
        <div class="col">
            <a href="newPost.php">
                <img src="../public/assets/img/new-post.png" alt="new-post" class="nav-icon">
            </a>
        </div>
        <div class="col">
            <a href="notice.php">
                <img src="../public/assets/img/notices.png" alt="notices" class="nav-icon">
            </a>
        </div>
        <div class="col">
            <a href="user.php?username=<?php echo $_SESSION["username"] ?>">
                <img src="../public/assets/img/profile.png" alt="profile" class="nav-icon">
            </a>
        </div>
    </div>
</nav>