<?php if (empty($res)) : ?>
    <h2 class="text-center">Nessun risultato</h2>
<?php else : ?>
    <?php foreach ($res as $r) : ?>
        <?php if ($r["username"] !== $currUser) : ?>
            <div class="d-flex justify-content-between border border-dark rounded bg-light text-dark p-3 m-2">
                <div class="d-flex align-items-center" style="width:40vw;">
                    <img src="<?php echo (UPLOAD_DIR . $r["nomefile"]) ?>" alt="profile-picture" style="width:3vw; height:3vw" />
                    <div class="">
                        <span class="font-weight-bold"><a href="user.php?username=<?php echo $r["username"] ?>">@<?php echo $r["username"] ?></a><br></span>
                        <span class="text-muted"><?php echo $r["bio"] ?></span>
                    </div>
                </div>
                <?php if ($mysqli->controllaSegue($r["username"], $currUser)) : ?>
                    <button type="button" id="<?php echo $r["username"] ?>" class="followBtn btn btn-primary btn-sm btn-block" style="width:5vw">Smetti di seguire</button>
            </div>
        <?php else : ?>
            <button type="button" id="" . $r["username"] . "" class="followBtn btn btn-primary btn-sm btn-block" style="width:5vw">Segui</button>
            </div>
<?php
                endif;
            endif;
        endforeach;
    endif;
