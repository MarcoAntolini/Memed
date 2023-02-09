<script src="../public/assets/js/settings.js"></script>

<div class="settings-container container d-flex flex-column justify-content-center align-items-start">
    <div class="settings-button" id="profile-settings" data-bs-toggle="modal" data-bs-target=".profile-edit">
        <img src="../public/assets/img/user-settings.png" alt="Modifica profilo">
        <span>Modifica profilo</span>
    </div>
    <div class="profile-edit modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div id="profile-edit" class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" id="close-button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" id="profile-pic-input" accept="image/png, image/jpg, image/jpeg" name="profile-pic-input">
                    <img id="profile-pic-preview" class="profile-pic" src="<?php echo (UPLOAD_DIR . $templateParams["profilo"][0]["nomefile"]); ?>" alt="profile-pic">
                    <textarea id="bio" class="bio" name="bio" rows="5"><?php echo $templateParams["profilo"][0]["bio"]; ?></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submit-button" class="btn btn-primary float-end">Salva</button>
                </div>
            </div>
        </div>
    </div>
    <div class="settings-button" id="saved-posts">
        <a href="saved.php">
            <img src="../public/assets/img/saved-posts.png" alt="Post salvati">
            <span>Post salvati</span>
        </a>
    </div>
    <div class="settings-button" id="logout" data-bs-toggle="modal" data-bs-target=".logout-form">
        <img src="../public/assets/img/logout.png" alt="Logout">
        <span>Logout</span>
    </div>
    <form class="logout-form modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1" action="#" method="post">
        <div id="logout-form" class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-items-center">
                    <h5 class="float-start pt-2">Sei sicuro?</h5>
                    <button type="submit" name="logout" class="btn btn-danger float-end fs-5">Logout</button>
                </div>
            </div>
        </div>
    </form>
</div>