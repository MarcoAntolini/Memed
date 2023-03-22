<header>
    <div class="header container-fluid d-flex justify-content-center color-main p-2 fixed-top top-0">
        <div class="col mobile-hidden">
            <h1 class="position-absolute float-start">Memed</h1>
        </div>
        <div class="col">
            <form id="search-form" action="../modules/search.php" method="GET" class="m-0">
                <div class="input-group">
                    <div class="form-floating form-group">
                        <input class="form-control" name="search" list="recents" id="search" placeholder="Cerca">
                        <label for="search" class="form-label">Cerca</label>
                    </div>
                    <button id="search-button" type="submit" class="btn btn-primary">
                        <img src="../public/assets/img/search.png" alt="search" class="search-icon">
                    </button>
                </div>
            </form>
        </div>
        <div class="col">
            <a href="settings.php" class="float-end btn">
                <img src="../public/assets/img/settings.png" alt="settings" class="settings-icon">
            </a>
        </div>
    </div>
</header>