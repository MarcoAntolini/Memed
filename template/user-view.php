<div class="my-profile">
    <div class="container">
        <div class="user-data-section">
            <img class="profile-pic" src="<?php echo (UPLOAD_DIR. $templateParams["profilo"][0]["nomefile"]); ?>" alt="profile-pic">
            <div class="username">
                <?php echo $templateParams["profilo"][0]["username"]; ?>
            </div>
            <div class="bio">
                <?php echo $templateParams["profilo"][0]["bio"]; ?>
            </div>
            <?php if($templateParams["utente"] != $_SESSION["username"]): ?>
                <div class="follow-section">
                    <?php if($templateParams["isFollowing"]): ?>
                        <form action="#" method="post">
                            <input type="hidden" name="unfollowing" value="<?php echo $templateParams["utente"]; ?>">
                            <button type="submit" class="btn btn-primary">Unfollow</button>
                        </form>
                    <?php else: ?>
                        <form action="#" method="post">
                            <input type="hidden" name="following" value="<?php echo $templateParams["utente"]; ?>">
                            <button type="submit" class="btn btn-primary">Follow</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <button class="follower-count btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".follower-list">
                Follower: <?php echo $templateParams["nFol"][0]; ?>
            </button>
            <button class="followed-count btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target=".followed-list">
                Seguiti: <?php echo $templateParams["nSeguiti"][0]; ?>
            </button>
            <div class="follower-list modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
                <div id="follower-list" class="modal-dialog modal-dialog-scrollable modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Follower</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php foreach ($templateParams["follower"] as $follower) : ?>
                                <div class="follower">
                                    <a href="user.php?username=<?php echo $follower["username"]; ?>">
                                        <?php echo $follower["username"]; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="followed-list modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
                <div id="followed-list" class="modal-dialog modal-dialog-scrollable modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Seguiti</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if ($templateParams["seguiti"]) : ?>
                                <?php foreach ($templateParams["seguiti"] as $followed) : ?>
                                    <div class="followed">
                                        <a href="user.php?username=<?php echo $followed["Fol_username"]; ?>">
                                            <?php echo $followed["Fol_username"]; ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="posts-section container">
            <?php
            if (isset($templateParams["js"])) :
                echo '<div id="post-section"></div>';
                foreach ($templateParams["js"] as $script) :
            ?>
                    <script src="<?php echo $script; ?>"></script>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>