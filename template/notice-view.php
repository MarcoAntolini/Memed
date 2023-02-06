<section class="container-fluid d-flex justify-content-center p-2">
    <div class="row">
        <form action="#" method="post">
        <div class="">
            <h2>Notifiche</h2>
            <p>Benvenuto <?php echo $templateParams["username"]; ?>, hai <?php echo $templateParams["numNotifiche"]; ?> notifiche</p>
            <button class="btn btn-primary" type="submit" name="leggi-tutto">leggi tutto</button> <!-- segna tutte come lette -->
            <button class="btn btn-primary" type="submit" name="cancella-tutto">cancella tutto</button>
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