<section class="container-fluid di-flex justify-content-center p-2">
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
                <input type="hidden" id="notifiche" value="<?php echo $templateParams["notifiche"]; ?>">
            </div>
        </form>
        <?php
        if (isset($templateParams["js"])) {
            echo '<div id="notice-section"></div>';
        }
        ?>
    </div>
</section>