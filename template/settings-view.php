<div class="container d-flex flex-column justify-content-center align-items-start">
    <div class="settings-button" id="profile-settings" data-bs-toggle="modal" data-bs-target=".profile-edit">
        <img src="../public/assets/img/user-settings.png" alt="Modifica profilo">
        <span>Modifica profilo</span>
    </div>
    <div class="profile-edit modal fade" role="dialog" data-bs-keyboard="false" data-bs-backdrop="static" tabindex="-1">
        <div id="profile-edit" class="modal-dialog modal-dialog-scrollable modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- TODO: -->
                </div>
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
                        <label class="form-check-label" for="switchNotices">Attiva notifiche</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- TODO: CORREGGERE -->
    <div class="settings-button" id="saved-posts"">
        <a href=" saved.php">
        <img src="../public/assets/img/saved-posts.png" alt="Post salvati">
        <span>Post salvati</span>
        </a>
    </div>
    <!-- TODO: CORREGGERE -->
    <div class="settings-button" id="logout"">
        <a href=" saved.php">
        <img src="../public/assets/img/logout.png" alt="Logout">
        <span>Logout</span>
        </a>
    </div>
</div>