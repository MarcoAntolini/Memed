<div class="notice-section container-fluid d-flex justify-content-center p-2">
    <div class="row">
        <div class="">
            <h2>Notifiche</h2>
            <button class="btn btn-primary"></button> <!-- segna tutte come lette -->
        </div>

        <?php
if (isset($templateParams["js"])) :
    echo '<div id="post-section"></div>';
    foreach ($templateParams["js"] as $script) :
?>
<script src="<?php echo $script; ?>"></script>
<?php
    endforeach;
endif;
?>
    </div>
</div>