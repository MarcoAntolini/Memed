<div class="header container-fluid d-flex justify-content-center color-main p-2 fixed-top">
    <div class="row gap-2 align-items-end">
        <div class="col">
            <img src="../public/assets/img/logo.png" alt="logo" class="logo" />
            <h1 class="title">Memed</h1>
        </div>
        <div class="col">
            <form action="#" method="post">
                <div class="input-group">
                    <div class="form-floating form-group">
                        <input class="form-control" name="search-input" list="recents" id="search-input" placeholder="Esplora">
                        <label for="search-input" class="form-label">Esplora</label>
                        <datalist id="recents">
                            <!-- TODO: ULTIME 5 RICERCHE RECENTI TRAMITE SESSION -->
                            <!-- <option value=""> -->
                        </datalist>
                    </div>
                    <button id="search-button" type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#users-preview" aria-expanded="false" aria-controls="users-preview">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="white" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="" />
                            <circle cx="10" cy="10" r="7" />
                            <line x1="21" y1="21" x2="15" y2="15" />
                        </svg>
                    </button>
                </div>
            </form>
            <div class="collapse" id="users-preview">
                <div class="card card-body">
                    <!-- TODO: QUI CI VANNO GLI UTENTI TROVATI -->
                </div>
            </div>
        </div>
        <div class="col">
            <a href="settings.php">
                <button class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-align-center" width="44" height="44" viewBox="0 0 24 24" stroke-width="2" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="4" y1="5" x2="20" y2="5" />
                        <line x1="4" y1="12" x2="20" y2="12" />
                        <line x1="4" y1="19" x2="20" y2="19" />
                    </svg>
                </button>
            </a>
        </div>
    </div>
</div>