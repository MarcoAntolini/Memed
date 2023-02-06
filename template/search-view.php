<script type="text/javascript" src="../public/assets/js/search.js"></script>

<section>
    <form action="#" method="post">
        <div class="input-group">
            <div class="form-floating form-group">
                <input class="form-control" list="recents" id="search-input" placeholder="Esplora">
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
</section>

<section>
    <div class="container d-flex gap-2">
        <!-- TODO: categorie per filtrare -->
        <!-- <input type="checkbox" name="" id="">
        <label for=""></label> -->
    </div>
    <?php
    if (isset($emplateParams["js"])) :
        echo '<div id="post-section"></div>';
        foreach ($templateParams["js"] as $script) :
    ?>
            <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</section>