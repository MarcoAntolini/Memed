<section class="container-fluid d-flex justify-content-center p-2">
    <div class="row">
        <form action="#" method="post">
            <div>
                <h2>Notifiche</h2>
                <p>Benvenuto <?php echo $templateParams["username"]; ?>, hai 
                <?php
                    $notifications = $templateParams["numNotifiche"]; 
                    echo $notifications;
                ?> notifiche</p>
                <button id="readall" class="btn btn-primary" type="submit" name="leggi-tutto">Leggi tutto</button> <!-- segna tutte come lette -->
                <button id="clearall" class="btn btn-primary" type="submit" name="cancella-tutto">Cancella tutto</button>
                <input type="hidden" id="notifications" value="<?php echo $notifications; ?>">
            </div>
        </form>
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
    </div>
</section>