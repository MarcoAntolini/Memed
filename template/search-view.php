<div class="search-container">
    <?php if (empty($res)) : ?>
        <h2 class="text-center">Nessun risultato</h2>
    <?php else : ?>
        <?php foreach ($res as $r) : ?>
            <?php if ($r["username"] !== $currUser) : ?>
                <div class="card p-2 mb-3">
                    <div class="">
                        <img src="<?php echo (UPLOAD_DIR . $r["nomefile"]) ?>" alt="profile-picture" />
                        <div class="">
                            <h2 class="fw-bold"><a href="user.php?username=<?php echo $r["username"] ?>">@<?php echo $r["username"] ?></a><br></h2>
                            <p class="text-muted"><?php echo $r["bio"] ?></p>
                        </div>
                    </div>
                    <?php if ($mysqli->controllaSegue($r["username"], $currUser)) : ?>
                        <button type="button" id="<?php echo $r["username"] ?>" class="btn btn-primary">Smetti di seguire</button>
                </div>
            <?php else : ?>
                <button type="button" id="<?php echo $r["username"] ?>" class="btn btn-primary">Segui</button>
</div>
<?php
                    endif;
                endif;
            endforeach;
        endif;
?>
</div>