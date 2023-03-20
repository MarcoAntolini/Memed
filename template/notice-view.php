<section class="notice-container di-flex p-2 card"">
    <div class=" row">
    <form action="#" method="post">
        <div>
            <p class="fw-bold">Hai <?php echo $templateParams["numNotifiche"]; ?> notifiche non lette</p>
            <button id="readall" class="btn btn-success" type="submit" name="leggi-tutto">Leggi tutto</button> <!-- segna tutte come lette -->
            <button id="clearall" class="btn btn-danger" type="submit" name="cancella-tutto">Cancella tutto</button>
            <input type="hidden" id="notifications-number" value="<?php echo $templateParams["numNotifiche"]; ?>">
            <input type="hidden" id="notification-Id" value="<?php echo $templateParams["notifiche"]; ?>">
        </div>
    </form>
    <?php
    if (isset($templateParams["js"])) {
        echo '<div id="notice-section"></div>';
    }
    ?>
    </div>
</section>