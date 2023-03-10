<div class="my-profile">
    <div class="user-data-section">
        <img class="profile-pic" src="<?php echo (UPLOAD_DIR . $templateParams["profilo"][0]["nomefile"]); ?>" alt="profile-pic">
        <h2 class="username">
            <?php echo $templateParams["profilo"][0]["username"]; ?>
        </h2>
        <p class="bio">
            <?php echo $templateParams["profilo"][0]["bio"]; ?>
        </p>
        <div>
            <button class="follower-count btn btn-info" type="button" data-bs-toggle="modal" data-bs-target=".follower-list">
                Follower: <?php echo $templateParams["nFol"][0]; ?>
            </button>
            <button class="followed-count btn btn-info" type="button" data-bs-toggle="modal" data-bs-target=".followed-list">
                Seguiti: <?php echo $templateParams["nSeguiti"][0]; ?>
            </button>
            <?php if ($templateParams["utente"] != $_SESSION["username"]) : ?>
                <div class="follow-section">
                    <?php if ($templateParams["isFollowing"]) : ?>
                        <form action="#" method="post">
                            <input type="hidden" name="unfollowing" value="<?php echo $templateParams["utente"]; ?>">
                            <button type="submit" class="btn btn-primary">Smetti di seguire</button>
                        </form>
                    <?php else : ?>
                        <form action="#" method="post">
                            <input type="hidden" name="following" value="<?php echo $templateParams["utente"]; ?>">
                            <button type="submit" class="btn btn-primary">Segui</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="follower-list modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
            <div id="follower-list" class="modal-dialog modal-dialog-scrollable modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Follower</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php if ($templateParams["follower"]) : ?>
                            <?php foreach ($templateParams["follower"] as $follower) : ?>
                                <div class="follower mb-3">
                                    <img src="<?php echo (UPLOAD_DIR . $mysqli->ottieniNomeFile($follower["username"])[0]); ?>" alt="follower-profile-pic">
                                    <a href="user.php?username=<?php echo $follower["username"]; ?>" class="fw-bold">
                                        @<?php echo $follower["username"]; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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
                                <div class="followed mb-3">
                                    <img src="<?php echo (UPLOAD_DIR . $mysqli->ottieniNomeFile($followed["Fol_username"])[0]); ?>" alt="followed-profile-pic">
                                    <a href="user.php?username=<?php echo $followed["Fol_username"]; ?>" class="fw-bold">
                                        @<?php echo $followed["Fol_username"]; ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($templateParams["js"])) {
        echo '<div id="post-section"></div>';
    }
    ?>
</div>