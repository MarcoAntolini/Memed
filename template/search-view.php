<div class="search-container">
    <?php if (empty($res)) : ?>
        <h2 class="text-center">Nessun risultato</h2>
    <?php else : ?>
        <?php foreach ($res as $r) : ?>
            <?php if ($r["Username"] !== $currUser) : ?>
                <div class="card p-2 mb-3">
                    <div class="">
                        <img src="<?php echo (UPLOAD_DIR . $r["FileName"]) ?>" alt="profile-picture" />
                        <div class="">
                            <h2 class="fw-bold"><a href="user.php?username=<?php echo $r["Username"] ?>">@<?php echo $r["Username"] ?></a><br></h2>
                            <p class="text-muted"><?php echo $r["Bio"] ?></p>
                        </div>
                    </div>
                    <?php if ($mysqli->checkFollow($r["Username"], $currUser)) : ?>
                        <button type="button" id="<?php echo $r["Username"] ?>" class="btn btn-primary">Smetti di seguire</button>
                </div>
            <?php else : ?>
                <button type="button" id="<?php echo $r["Username"] ?>" class="btn btn-primary">Segui</button>
</div>
<?php
                    endif;
                endif;
            endforeach;
        endif;
?>
</div>