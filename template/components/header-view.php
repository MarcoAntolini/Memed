<div class="header container-fluid d-flex justify-content-center color-main p-2 fixed-top">
    <div class="row gap-2 align-items-end">
        <div class="col">
            <img src="../public/assets/img/logo.png" alt="logo" class="logo" />
            <h1 class="title">Memed</h1>
        </div>
        <div class="col">
            <form id="search-form" action="../modules/search.php" name="" method="GET">
                <div class="input-group">
                    <div class="form-floating form-group">
                        <input class="form-control" name="search" list="recents" id="search" placeholder="Cerca">
                        <label for="search-input" class="form-label">Cerca</label>
                    </div>
                    <button id="search-button" type="submit" class="btn btn-primary">
                        <img src="../public/assets/img/search.png" alt="search">
                    </button>
                </div>
            </form>
        </div>
        <div class="col">
            <a href="settings.php">
                <button class="btn">
                    <img src="../public/assets/img/settings.png" alt="settings">
                </button>
            </a>
        </div>
    </div>
</div>