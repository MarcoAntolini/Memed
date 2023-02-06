<?php
if (isset($templateParams["js"])) :
    echo '<div id="notice-section"></div>';
    foreach ($templateParams["js"] as $script) :
?>
        <script src="<?php echo $script; ?>"></script>
<?php
    endforeach;
endif;
?>

<div class="settings-container container d-flex flex-column justify-content-center align-items-start">
    <div class="settings-button" id="profile-settings" data-bs-toggle="modal" data-bs-target=".profile-edit">
        <img src="../public/assets/img/user-settings.png" alt="Modifica profilo">
        <span>Modifica profilo</span>
    </div>
    <div class="profile-edit modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div id="profile-edit" class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="post">
                    <div class="modal-body">
                        <input type="file" id="profile-pic-input" accept="image/png, image/jpg, image/jpeg" name="profile-pic-input">
                        <img id="profile-pic-preview" class="profile-pic" src="<?php echo $templateParams["profilo"][0]["nomefile"]; ?>" alt="profile-pic">
                        <textarea id="bio" class="bio" rows="5"><?php echo $templateParams["profilo"][0]["bio"]; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary float-start">Annulla</button>
                        <button type="submit" name="submit" class="btn btn-primary float-end">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="settings-button" id="notice-settings" data-bs-toggle="modal" data-bs-target=".notice-switch">
        <img src="../public/assets/img/notice-settings.png" alt="Impostazioni notifiche">
        <span>Impostazioni notifiche</span>
    </div>
    <div class="notice-switch modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div id="notice-switch" class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="switchNotices">
                        <!-- TODO: GESTIRE NOTIFICHE -->
                        <label class="form-check-label" for="switchNotices">Attiva notifiche</label>
                    </div>
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