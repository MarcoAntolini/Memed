<nav class="footer container-fluid d-flex justify-content-center color-main p-2 fixed-bottom">
    <div class="row gap-2">
        <div class="col">
            <a href="index.php">
                <img src="../public/assets/img/home.png" alt="homepage">
            </a>
        </div>
        <div class="col">
            <a href="explore.php">
                <img src="../public/assets/img/explore.png" alt="explore">
            </a>
        </div>
        <div class="col">
            <a href="newPost.php">
                <img src="../public/assets/img/new-post.png" alt="new-post">
            </a>
        </div>
        <div class="col">
            <a href="notice.php">
                <img src="../public/assets/img/notices.png" alt="notices">
            </a>
        </div>
        <div class="col">
            <a href="user.php?username=<?php echo $_SESSION["username"] ?>">
                <img src="../public/assets/img/profile.png" alt="profile">
            </a>
        </div>
    </div>
</nav>