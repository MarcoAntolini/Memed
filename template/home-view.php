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
<!-- TODO: aggiungere notifiche in versione desktop -->